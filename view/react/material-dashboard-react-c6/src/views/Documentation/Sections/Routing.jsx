import React from "react";

// @material-ui/core components
import withStyles from "@material-ui/core/styles/withStyles";

// @material-ui/icons

// core components
import GridContainer from "components/Grid/GridContainer.jsx";
import GridItem from "components/Grid/GridItem.jsx";
import tabsStyle from "assets/jss/material-kit-react/views/componentsSections/tabsStyle.jsx";

import renderHTML from 'react-render-html';

const code = "                    <span style=\"overflow-x: scroll\"> <span style=\"color: #0000BB\">                 </span><span style=\"color: #007700\"><?</span><span style=\"color: #0000BB\">php<br /></span><span style=\"color: #FF8000\">/**<br /> * Created by IntelliJ IDEA.<br /> * User: Miles<br /> * Date: 1/17/17<br /> * Time: 11:48 AM<br /> */<br /><br /></span><span style=\"color: #007700\">namespace </span><span style=\"color: #0000BB\">CarbonPHP</span><span style=\"color: #007700\">;<br /><br /><br />use </span><span style=\"color: #0000BB\">CarbonPHP</span><span style=\"color: #007700\">\\</span><span style=\"color: #0000BB\">Error</span><span style=\"color: #007700\">\\</span><span style=\"color: #0000BB\">PublicAlert</span><span style=\"color: #007700\">;<br /><br />abstract class </span><span style=\"color: #0000BB\">Route<br /></span><span style=\"color: #007700\">{<br />    use </span><span style=\"color: #0000BB\">Singleton</span><span style=\"color: #007700\">;                </span><span style=\"color: #FF8000\">// We use the add method function to bind the closure to the class<br /><br />    /**<br />     * @var array $uri will hold an exploded array with the<br />     * back slash '\\' as our delimiter<br />     */<br />    </span><span style=\"color: #007700\">public </span><span style=\"color: #0000BB\">$uri</span><span style=\"color: #007700\">;<br />    </span><span style=\"color: #FF8000\">/**<br />     * @var int $uriLength will hold the current number of fields<br />     * separated by backslashes<br />     */<br />    </span><span style=\"color: #007700\">public </span><span style=\"color: #0000BB\">$uriLength</span><span style=\"color: #007700\">;<br />    </span><span style=\"color: #FF8000\">/**<br />     * @var bool|string $matched will equal \"true\" if the<br />     * current state has not executed a lambda function in response.<br />     * If a function has been executed the value of matched will be<br />     * true;<br />     */<br />    </span><span style=\"color: #007700\">public </span><span style=\"color: #0000BB\">$matched </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">false</span><span style=\"color: #007700\">;             </span><span style=\"color: #FF8000\">// a bool<br />    /**<br />     * @var callable $closure will hold the function to execute if<br />     * the match function should accept a given path-to-match. Arguments<br />     * can be specified in the variable length parameter field $argv.<br />     * See Route.Match(...)<br />     */<br />    </span><span style=\"color: #007700\">protected </span><span style=\"color: #0000BB\">$closure</span><span style=\"color: #007700\">;           </span><span style=\"color: #FF8000\">// The MVC pattern is currently passes<br /><br />    /**<br />     * This function must be implemented by the user to use the Route Class.<br />     * If no url is provided in $_SERVER['REQUEST_URI'], or $matched is<br />     * false when this class destructs the default route will be executed.<br />     * @return mixed<br />     */<br />    </span><span style=\"color: #007700\">abstract public function </span><span style=\"color: #0000BB\">defaultRoute</span><span style=\"color: #007700\">();<br /><br />    </span><span style=\"color: #FF8000\">/**<br />     * Will be run when the active object is destroyed. If the<br />     * $matched variable is false then our default route will be<br />     * executed. If matched is set to \"true\", indicating that<br />     * no callable has been run, no errors or warnings will be printed.<br />     * This is by design.<br />     */<br />    </span><span style=\"color: #007700\">public function </span><span style=\"color: #0000BB\">__destruct</span><span style=\"color: #007700\">()<br />    {<br />        if (</span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">matched</span><span style=\"color: #007700\">) {<br />            return;<br />        }<br />        if (</span><span style=\"color: #0000BB\">SOCKET</span><span style=\"color: #007700\">) {<br />            print </span><span style=\"color: #DD0000\">'Socket Left Route Class Un-Matched' </span><span style=\"color: #007700\">. </span><span style=\"color: #0000BB\">PHP_EOL</span><span style=\"color: #007700\">;<br />            exit(</span><span style=\"color: #0000BB\">1</span><span style=\"color: #007700\">);<br />        }<br /><br />        </span><span style=\"color: #FF8000\">/*<br />        if (AJAX) {<br />            print 'AJAX Left Route Class Un-Matched' . PHP_EOL;<br />            exit(1);<br />        }<br />        */<br /><br />        </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">matched </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">true</span><span style=\"color: #007700\">;<br />        </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">defaultRoute</span><span style=\"color: #007700\">();<br />    }<br /><br /><br />    </span><span style=\"color: #FF8000\">/**<br />     * Route constructor. If the url is / or null then our<br />     * default route will be invoked.<br />     * @param callable|null $structure<br />     * @throws PublicAlert<br />     */<br />    </span><span style=\"color: #007700\">public function </span><span style=\"color: #0000BB\">__construct</span><span style=\"color: #007700\">(callable </span><span style=\"color: #0000BB\">$structure </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">null</span><span style=\"color: #007700\">)<br />    {<br />        </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">closure </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">$structure</span><span style=\"color: #007700\">;<br />        </span><span style=\"color: #FF8000\">// This check allows Route to be independent of Carbon/Application, but benefit if we've already initiated<br />        </span><span style=\"color: #007700\">if (\\</span><span style=\"color: #0000BB\">defined</span><span style=\"color: #007700\">(</span><span style=\"color: #DD0000\">'URI'</span><span style=\"color: #007700\">) && !</span><span style=\"color: #0000BB\">SOCKET</span><span style=\"color: #007700\">) {<br />            </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">uri </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">explode</span><span style=\"color: #007700\">(</span><span style=\"color: #DD0000\">'/'</span><span style=\"color: #007700\">, </span><span style=\"color: #0000BB\">trim</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">URI</span><span style=\"color: #007700\">, </span><span style=\"color: #DD0000\">'/'</span><span style=\"color: #007700\">));<br />            </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">uriLength </span><span style=\"color: #007700\">= \\</span><span style=\"color: #0000BB\">count</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">uri</span><span style=\"color: #007700\">);<br />        } else {<br />            </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">uri </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">explode</span><span style=\"color: #007700\">(</span><span style=\"color: #DD0000\">'/'</span><span style=\"color: #007700\">, </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">uriLength </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">trim</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">urldecode</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">parse_url</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">trim</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">preg_replace</span><span style=\"color: #007700\">(</span><span style=\"color: #DD0000\">'/\\s+/'</span><span style=\"color: #007700\">, </span><span style=\"color: #DD0000\">' '</span><span style=\"color: #007700\">, </span><span style=\"color: #0000BB\">$_SERVER</span><span style=\"color: #007700\">[</span><span style=\"color: #DD0000\">'REQUEST_URI'</span><span style=\"color: #007700\">])), </span><span style=\"color: #0000BB\">PHP_URL_PATH</span><span style=\"color: #007700\">)), </span><span style=\"color: #DD0000\">' /'</span><span style=\"color: #007700\">));<br />            </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">uriLength </span><span style=\"color: #007700\">= \\</span><span style=\"color: #0000BB\">substr_count</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">uriLength</span><span style=\"color: #007700\">, </span><span style=\"color: #DD0000\">'/'</span><span style=\"color: #007700\">) + </span><span style=\"color: #0000BB\">1</span><span style=\"color: #007700\">; </span><span style=\"color: #FF8000\">// I need the exploded string<br />        </span><span style=\"color: #007700\">}<br /><br />    }<br /><br />    </span><span style=\"color: #FF8000\">/**<br />     * @param string $uri<br />     */<br />    </span><span style=\"color: #007700\">public function </span><span style=\"color: #0000BB\">changeURI</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">string $uri</span><span style=\"color: #007700\">): </span><span style=\"color: #0000BB\">void<br />    </span><span style=\"color: #007700\">{<br />        </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">uri </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">explode</span><span style=\"color: #007700\">(</span><span style=\"color: #DD0000\">'/'</span><span style=\"color: #007700\">, </span><span style=\"color: #0000BB\">$uri </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">trim</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$uri</span><span style=\"color: #007700\">, </span><span style=\"color: #DD0000\">'/'</span><span style=\"color: #007700\">));<br />        </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">uriLength </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">substr_count</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$uri</span><span style=\"color: #007700\">, </span><span style=\"color: #DD0000\">'/'</span><span style=\"color: #007700\">) + </span><span style=\"color: #0000BB\">1</span><span style=\"color: #007700\">;<br />        </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">matched </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">false</span><span style=\"color: #007700\">;<br />    }<br /><br />    </span><span style=\"color: #FF8000\">/** This will return the current value of $this->matched.<br />     * Added to allow us to quickly check the status using the<br />     * (string) type cast<br />     * @return bool<br />     */<br />    </span><span style=\"color: #007700\">public function </span><span style=\"color: #0000BB\">__invoke</span><span style=\"color: #007700\">()<br />    {<br />        return (bool)</span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">matched</span><span style=\"color: #007700\">;<br />    }<br /><br />    </span><span style=\"color: #FF8000\">/** This sets a default route to execute immediately when<br />     * our match function is successful. Useful when multiple routes<br />     * rely on the same algorithm. Parameters used in the closure<br />     * may be specified using the match function.<br />     * @param callable|null $struct<br />     * @return Route<br />     */<br />    </span><span style=\"color: #007700\">public function </span><span style=\"color: #0000BB\">structure</span><span style=\"color: #007700\">(callable </span><span style=\"color: #0000BB\">$struct </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">null</span><span style=\"color: #007700\">): </span><span style=\"color: #0000BB\">Route<br />    </span><span style=\"color: #007700\">{<br />        </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">closure </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">$struct</span><span style=\"color: #007700\">;<br />        return </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">;<br />    }<br /><br /><br />    </span><span style=\"color: #FF8000\">/** // TODO - comment this<br />     * @param string $pathToMatch<br />     * @param array ...$argv<br />     * @return Route<br />     * @throws PublicAlert<br />     */<br />    </span><span style=\"color: #007700\">public function </span><span style=\"color: #0000BB\">match</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">string $pathToMatch</span><span style=\"color: #007700\">, ...</span><span style=\"color: #0000BB\">$argv</span><span style=\"color: #007700\">): </span><span style=\"color: #0000BB\">self<br />    </span><span style=\"color: #007700\">{<br />        </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">storage </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">$argv</span><span style=\"color: #007700\">;  </span><span style=\"color: #FF8000\">// This is for home route function (singleton)<br /><br />        </span><span style=\"color: #0000BB\">$uri </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">uri</span><span style=\"color: #007700\">;<br /><br />        </span><span style=\"color: #0000BB\">$arrayToMatch </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">explode</span><span style=\"color: #007700\">(</span><span style=\"color: #DD0000\">'/'</span><span style=\"color: #007700\">, </span><span style=\"color: #0000BB\">trim</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$pathToMatch</span><span style=\"color: #007700\">, </span><span style=\"color: #DD0000\">'/'</span><span style=\"color: #007700\">));<br /><br />        </span><span style=\"color: #0000BB\">$pathLength </span><span style=\"color: #007700\">= \\</span><span style=\"color: #0000BB\">count</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$arrayToMatch</span><span style=\"color: #007700\">);<br /><br />        </span><span style=\"color: #0000BB\">$pathLength </span><span style=\"color: #007700\">=== </span><span style=\"color: #0000BB\">0 </span><span style=\"color: #007700\">and </span><span style=\"color: #0000BB\">$pathToMatch </span><span style=\"color: #007700\">= </span><span style=\"color: #DD0000\">'*'</span><span style=\"color: #007700\">;   </span><span style=\"color: #FF8000\">// shorthand if stmt<br /><br />        // The order of the following<br />        </span><span style=\"color: #007700\">if (</span><span style=\"color: #0000BB\">$pathLength </span><span style=\"color: #007700\">< </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">uriLength </span><span style=\"color: #007700\">&& </span><span style=\"color: #0000BB\">substr</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$pathToMatch</span><span style=\"color: #007700\">, -</span><span style=\"color: #0000BB\">1</span><span style=\"color: #007700\">) !== </span><span style=\"color: #DD0000\">'*'</span><span style=\"color: #007700\">) {<br />            return </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">;<br />        }<br /><br />        </span><span style=\"color: #0000BB\">$required </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">true</span><span style=\"color: #007700\">;       </span><span style=\"color: #FF8000\">// variables can be made optional by `?`<br />        </span><span style=\"color: #0000BB\">$variables </span><span style=\"color: #007700\">= array();<br /><br />        for (</span><span style=\"color: #0000BB\">$i </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">0</span><span style=\"color: #007700\">; </span><span style=\"color: #0000BB\">$i </span><span style=\"color: #007700\"><= </span><span style=\"color: #0000BB\">$pathLength</span><span style=\"color: #007700\">; </span><span style=\"color: #0000BB\">$i</span><span style=\"color: #007700\">++) {<br /><br />            </span><span style=\"color: #FF8000\">// set up our ending condition<br />            </span><span style=\"color: #007700\">if (</span><span style=\"color: #0000BB\">$pathLength </span><span style=\"color: #007700\">=== </span><span style=\"color: #0000BB\">$i </span><span style=\"color: #007700\">|| </span><span style=\"color: #0000BB\">$arrayToMatch</span><span style=\"color: #007700\">[</span><span style=\"color: #0000BB\">$i</span><span style=\"color: #007700\">] === </span><span style=\"color: #0000BB\">null</span><span style=\"color: #007700\">) {<br />                </span><span style=\"color: #0000BB\">$arrayToMatch</span><span style=\"color: #007700\">[</span><span style=\"color: #0000BB\">$i</span><span style=\"color: #007700\">] = </span><span style=\"color: #DD0000\">'*'</span><span style=\"color: #007700\">;<br />            }<br /><br />            switch (</span><span style=\"color: #0000BB\">$arrayToMatch</span><span style=\"color: #007700\">[</span><span style=\"color: #0000BB\">$i</span><span style=\"color: #007700\">][</span><span style=\"color: #0000BB\">0</span><span style=\"color: #007700\">]) {<br />                case  </span><span style=\"color: #DD0000\">'*'</span><span style=\"color: #007700\">:<br />                    </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">matched </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">true</span><span style=\"color: #007700\">;<br />                    </span><span style=\"color: #0000BB\">$referenceVariables </span><span style=\"color: #007700\">= [];<br /><br />                    foreach (</span><span style=\"color: #0000BB\">$variables </span><span style=\"color: #007700\">as </span><span style=\"color: #0000BB\">$key </span><span style=\"color: #007700\">=> </span><span style=\"color: #0000BB\">$value</span><span style=\"color: #007700\">) {<br />                        </span><span style=\"color: #0000BB\">$GLOBALS</span><span style=\"color: #007700\">[</span><span style=\"color: #0000BB\">$key</span><span style=\"color: #007700\">] = </span><span style=\"color: #0000BB\">$value</span><span style=\"color: #007700\">;                    </span><span style=\"color: #FF8000\">// this must be done in two lines<br />                        </span><span style=\"color: #0000BB\">$referenceVariables</span><span style=\"color: #007700\">[] = &</span><span style=\"color: #0000BB\">$GLOBALS</span><span style=\"color: #007700\">[</span><span style=\"color: #0000BB\">$key</span><span style=\"color: #007700\">];<br />                    }<br /><br />                    </span><span style=\"color: #FF8000\">// Variables captured in the path to match will passed to the closure<br />                    </span><span style=\"color: #007700\">if (\\</span><span style=\"color: #0000BB\">is_callable</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$argv</span><span style=\"color: #007700\">[</span><span style=\"color: #0000BB\">0</span><span style=\"color: #007700\">])) {<br />                        </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">addMethod</span><span style=\"color: #007700\">(</span><span style=\"color: #DD0000\">'routeMatched'</span><span style=\"color: #007700\">, </span><span style=\"color: #0000BB\">$argv</span><span style=\"color: #007700\">[</span><span style=\"color: #0000BB\">0</span><span style=\"color: #007700\">]);<br />                        if (\\</span><span style=\"color: #0000BB\">call_user_func_array</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">methods</span><span style=\"color: #007700\">[</span><span style=\"color: #DD0000\">'routeMatched'</span><span style=\"color: #007700\">], </span><span style=\"color: #0000BB\">$referenceVariables</span><span style=\"color: #007700\">) === </span><span style=\"color: #0000BB\">false</span><span style=\"color: #007700\">) {<br />                            throw new </span><span style=\"color: #0000BB\">PublicAlert</span><span style=\"color: #007700\">(</span><span style=\"color: #DD0000\">'Bad Closure Passed to Route::match()'</span><span style=\"color: #007700\">);<br />                        }<br />                        return </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">;<br />                    }<br /><br />                    </span><span style=\"color: #FF8000\">// If variables were captured in our path to match, they will be merged with our variable list provided with $argv<br />                    </span><span style=\"color: #007700\">if (\\</span><span style=\"color: #0000BB\">is_callable</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">closure</span><span style=\"color: #007700\">)) {<br />                        </span><span style=\"color: #0000BB\">$argv</span><span style=\"color: #007700\">[] = &</span><span style=\"color: #0000BB\">$referenceVariables</span><span style=\"color: #007700\">;<br />                        </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">addMethod</span><span style=\"color: #007700\">(</span><span style=\"color: #DD0000\">'routeMatched'</span><span style=\"color: #007700\">, </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">closure</span><span style=\"color: #007700\">);<br />                        \\</span><span style=\"color: #0000BB\">call_user_func_array</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">-></span><span style=\"color: #0000BB\">methods</span><span style=\"color: #007700\">[</span><span style=\"color: #DD0000\">'routeMatched'</span><span style=\"color: #007700\">], </span><span style=\"color: #0000BB\">$argv</span><span style=\"color: #007700\">);<br />                        return </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">;<br />                    }<br />                    return </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">;<br /><br />                case </span><span style=\"color: #DD0000\">'{'</span><span style=\"color: #007700\">: </span><span style=\"color: #FF8000\">// this is going to indicate the start of a variable name<br /><br />                    </span><span style=\"color: #007700\">if (</span><span style=\"color: #0000BB\">substr</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$arrayToMatch</span><span style=\"color: #007700\">[</span><span style=\"color: #0000BB\">$i</span><span style=\"color: #007700\">], -</span><span style=\"color: #0000BB\">1</span><span style=\"color: #007700\">) !== </span><span style=\"color: #DD0000\">'}'</span><span style=\"color: #007700\">) {<br />                        throw new </span><span style=\"color: #0000BB\">PublicAlert</span><span style=\"color: #007700\">(</span><span style=\"color: #DD0000\">'Variable declaration must be rapped in brackets. ie `/{var}/`'</span><span style=\"color: #007700\">);<br />                    }<br /><br />                    </span><span style=\"color: #0000BB\">$variable </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">rtrim</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">ltrim</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$arrayToMatch</span><span style=\"color: #007700\">[</span><span style=\"color: #0000BB\">$i</span><span style=\"color: #007700\">], </span><span style=\"color: #DD0000\">'{'</span><span style=\"color: #007700\">), </span><span style=\"color: #DD0000\">'}'</span><span style=\"color: #007700\">);<br /><br />                    if (</span><span style=\"color: #0000BB\">substr</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$variable</span><span style=\"color: #007700\">, -</span><span style=\"color: #0000BB\">1</span><span style=\"color: #007700\">) === </span><span style=\"color: #DD0000\">'?' </span><span style=\"color: #007700\">&& </span><span style=\"color: #0000BB\">$variable </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">rtrim</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$variable</span><span style=\"color: #007700\">, </span><span style=\"color: #DD0000\">'?'</span><span style=\"color: #007700\">)) {<br />                        </span><span style=\"color: #0000BB\">$required </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">false</span><span style=\"color: #007700\">;<br />                    }<br /><br />                    if (empty(</span><span style=\"color: #0000BB\">$variable</span><span style=\"color: #007700\">)) {<br />                        throw new </span><span style=\"color: #0000BB\">PublicAlert</span><span style=\"color: #007700\">(</span><span style=\"color: #DD0000\">'Variable must have a name association. ie  `/{var}/`'</span><span style=\"color: #007700\">);<br />                    }<br /><br />                    </span><span style=\"color: #0000BB\">$value </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">null</span><span style=\"color: #007700\">;<br /><br />                    if (</span><span style=\"color: #0000BB\">array_key_exists</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$i</span><span style=\"color: #007700\">, </span><span style=\"color: #0000BB\">$uri</span><span style=\"color: #007700\">)) {<br />                        </span><span style=\"color: #0000BB\">$value </span><span style=\"color: #007700\">= </span><span style=\"color: #0000BB\">$uri</span><span style=\"color: #007700\">[</span><span style=\"color: #0000BB\">$i</span><span style=\"color: #007700\">];<br />                    }<br />                    if (</span><span style=\"color: #0000BB\">$required </span><span style=\"color: #007700\">=== </span><span style=\"color: #0000BB\">true </span><span style=\"color: #007700\">&& </span><span style=\"color: #0000BB\">$value </span><span style=\"color: #007700\">=== </span><span style=\"color: #0000BB\">null</span><span style=\"color: #007700\">) {<br />                        return </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">;<br />                    }<br />                    </span><span style=\"color: #0000BB\">$variables</span><span style=\"color: #007700\">[</span><span style=\"color: #0000BB\">$variable</span><span style=\"color: #007700\">] = </span><span style=\"color: #0000BB\">$value</span><span style=\"color: #007700\">;<br />                    break;<br />                default:<br />                    if (!</span><span style=\"color: #0000BB\">array_key_exists</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$i</span><span style=\"color: #007700\">, </span><span style=\"color: #0000BB\">$uri</span><span style=\"color: #007700\">)) {<br />                        return </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">;<br />                    }<br />                    if (</span><span style=\"color: #0000BB\">strtolower</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$arrayToMatch</span><span style=\"color: #007700\">[</span><span style=\"color: #0000BB\">$i</span><span style=\"color: #007700\">]) !== </span><span style=\"color: #0000BB\">strtolower</span><span style=\"color: #007700\">(</span><span style=\"color: #0000BB\">$uri</span><span style=\"color: #007700\">[</span><span style=\"color: #0000BB\">$i</span><span style=\"color: #007700\">])) {<br />                        return </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">;<br />                    }<br />            }<br />        }<br />        return </span><span style=\"color: #0000BB\">$this</span><span style=\"color: #007700\">;<br />    }<br />}<br /><br /><br /><br /></span>\n" +
    "\n" +
    "</span>\n" +
    "                ";

class SectionTabs extends React.Component {
  render() {
    const { classes } = this.props;
    return (
      <div className={classes.section}>
        <div className={classes.container}>
          <div id="nav-tabs">
            <h3>The Route Class</h3>
            <GridContainer>
              <GridItem xs={12} sm={12} md={12}>
                <h3>
                  <small>map your urls</small>
                </h3>
                  <p>
                      This class will map urls with variable arguments. It was designed for portability and SEO optimization. You must define a default route using the abstract public function defaultRoute(); for an example of this class in action see the Bootstrap page.
                  </p>
                <p><code>
                    {renderHTML(code)}</code>
                </p>
              </GridItem>

            </GridContainer>
          </div>
        </div>
      </div>
    );
  }
}

export default withStyles(tabsStyle)(SectionTabs);
