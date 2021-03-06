<?php
/**
 * Created by IntelliJ IDEA.
 * User: richardmiles
 * Date: 2/25/18
 * Time: 3:20 AM
 */

namespace CarbonPHP;


use CarbonPHP\Error\ErrorCatcher;
use CarbonPHP\Error\PublicAlert;
use Error;
use Mustache_Exception_InvalidArgumentException;

abstract class Application extends Route
{

    /**
     * This functions should change the $matched property in the extended Route class to true.
     * public bool $matched = false;
     * This can happen by using the Routing methods to produce a match, or setting it explicitly.
     * If the start application method finishes with $matched = false; your defaultRoute() method will run.
     *
     *
     * @param string $uri
     * @return bool  - REQUIRED, it seems like we use it anywhere at first glance, but its apart of a
     *                  recursive ending condition for Application::ControllerModelView
     */
    abstract public function startApplication(string $uri): bool;

    /**
     * App constructor. If no uri is set than
     * the Route constructor will execute the
     * defaultRoute method defined below.
     * @return callable
     * @throws Mustache_Exception_InvalidArgumentException
     */

    public function fullPage(): callable
    {
        return static function (string $file) {
            self::$matched = true;
            /** @noinspection PhpIncludeInspection */
            return include CarbonPHP::$app_root . CarbonPHP::$app_view . $file;
        };
    }

    public function wrap(): callable
    {
        /**
         * @param string $file
         * @return bool
         * @throws Mustache_Exception_InvalidArgumentException
         */
        return static function (string $file): bool {
            self::$matched = true;
            return View::content(CarbonPHP::$app_view . $file, CarbonPHP::$app_root);
        };
    }

    private static string $CONTROLLER_NAMESPACE = 'Controller\\';
    private static string $MODEL_NAMESPACE = 'Model\\';

    /**Stands for Controller -> Model .
     *
     * This will run the controller/$class.$method().
     * If the method returns !empty() the model/$class.$method() will be
     * invoked. If an array is returned from the controller its values
     * will be passed as parameters to our model.
     * @link http://php.net/manual/en/function.call-user-func-array.php
     *
     * @param string $class This class name to autoload
     * @param string $method The method within the provided class
     * @param array $argv Arguments to be passed to method
     * @return mixed the returned value from model/$class.$method() or false | void
     */
    public static function CM(string $class, string &$method, array &$argv = []): callable
    {
        $class = ucfirst(strtolower($class));   // Prevent malformed class names
        $method = strtolower($method);          // Prevent malformed method names

        $controller = self::$CONTROLLER_NAMESPACE . $class;     // add namespace for autoloader
        $model = self::$MODEL_NAMESPACE . $class;

        return static function () use ($controller, $model, $method, $argv) {

            // Make sure our Controller exists
            if (!class_exists($controller)) {
                throw new Error("Invalid Controller ({$controller}) Passed to MVC. Please ensure your namespace mappings are correct!");
            }

            $argv = \call_user_func_array([new $controller, $method], $argv);

            if ($argv !== null && $argv !== false) {

                // Make sure our Model exists
                if (!class_exists($model)) {
                    throw new Error("Invalid Model ({$model}) Passed to MVC. Please ensure your namespace mappings are correct!");
                }

                return \call_user_func_array([new $model, $method], is_array($argv) ? $argv : [$argv]);
            }

            return $argv;   // false will indicate (in mvc) that the view should not run
        };
    }

    /** Stands for Controller -> Model -> View
     *
     * This will run the controller/$class.$method().
     * If the method returns true the model/$class.$method() will be
     * invoked. If an array is returned from the controller its values
     * will be passed as parameters to our model. Finally the View will
     * be executed. The file should be in the CarbonPHP::$app_view directory (set in config)
     * with the following naming convention
     *
     *  CarbonPHP::$app_view / $class / $method . (php | hbs)  - We accept handlebar templates.
     *
     * The view will be processed server-side and returned
     *
     * @link http://php.net/manual/en/function.call-user-func-array.php
     * @link http://php.net/manual/en/language.oop5.late-static-bindings.php
     *
     * @param string $class This class name to autoload
     * @param string $method The method within the provided class
     * @param array $argv Arguments to be passed to method
     * @return bool - false if the view, controller, or model returned false.
     */
    private static int $STACK_COUNT = 0;
    private static string $CLASS;
    private static string $METHOD;

    public static function ControllerModelView(string $class, string $method, array &$argv = []): bool
    {
        self::$CLASS = $class;
        self::$METHOD = $method;

        $recurse = self::$STACK_COUNT; // where we're at now

        // keep track of which recursive iteration this is.
        self::$STACK_COUNT++;

        // make a call which may recurse
        if (false === ErrorCatcher::catchErrors(static::CM($class, $method, $argv))()) {  // Controller -> Model
            return false;
        }

        // This is so we can clear our stack quickly if recursively called, which helps with error reporting
        if ($recurse !== 0) {
            return true;
        }

        // try to find the file
        $file = CarbonPHP::$app_view . strtolower(self::$CLASS) . '/' . strtolower(self::$METHOD);

        if (!file_exists(CarbonPHP::$app_root . $file . ($ext = '.php')) && !file_exists(CarbonPHP::$app_root . $file . ($ext = '.hbs'))) {
            $ext = '';
        }

        // tell the view to send this file
        return View::content($file . $ext, CarbonPHP::$app_root);
    }

    public static function MVC(string $controllerNamespace = null, string $modelNamespace = null): callable
    {
        if ($controllerNamespace !== null) {
            self::$CONTROLLER_NAMESPACE = $controllerNamespace;
        }
        if ($modelNamespace !== null) {
            self::$MODEL_NAMESPACE = $modelNamespace;
        }
        return static function (string $class, string $method, array &$argv = []) {
            self::$matched = true;
            return self::ControllerModelView($class, $method, $argv);
        };
    }

    public static function JSON($selector = '#pjax-content'): callable
    {
        return static function ($class, $method, $argv) use ($selector) {
            global $alert, $json;

            self::$matched = true;

            if (false === $return = ErrorCatcher::catchErrors(static::CM($class, $method, $argv))()) {
                return null;
            }

            if (!file_exists(CarbonPHP::$app_root . $file = (CarbonPHP::$app_view . $class . DS . $method . '.hbs'))) {
                $alert = 'Mustache Template Not Found ' . $file;
            }

            if (!\is_array($alert)) {
                $alert = [];
            }

            if (!\is_array($json)) {
                $json = [];
            }

            $json = array_merge_recursive($json, [
                'errors' => $alert,
                'controller->model' => $class,
                'method' => $method,
                'argv' => $argv,
                'return' => $return,
                'widget' => $selector
            ]);

            header('Content-Type: application/json', true, 200); // Send as JSON

            if (false === $json = json_encode($json)) {
                PublicAlert::danger('Json Failed to encode, this may occur when trying to encode binary content.');
                $json = json_encode($json); // todo - why did we retry?
            }

            CarbonPHP::$socket and $json = PHP_EOL . $json . PHP_EOL;

            print $json; // new line ensures it sends through the socket

            return true;
        };
    }
}
