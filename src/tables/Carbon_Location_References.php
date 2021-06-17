<?php /** @noinspection DuplicatedCode */

namespace CarbonPHP\Tables;

// Restful defaults
use CarbonPHP\Database;
use CarbonPHP\Error\PublicAlert;
use CarbonPHP\Interfaces\iRestNoPrimaryKey;
use CarbonPHP\Helpers\RestfulValidations;
use CarbonPHP\Rest;
use JsonException;
use PDO;
use PDOException;
use function array_key_exists;
use function count;
use function func_get_args;
use function is_array;

// Custom User Imports


/**
 *
 * Class Carbon_Location_References
 * @package CarbonPHP\Tables
 * @note Note for convenience, a flag '-prefix' maybe passed to remove table prefixes.
 *  Use '-help' for a full list of options.
 * @link https://carbonphp.com/ 
 *
 * This class contains autogenerated code.
 * This class is a 1=1 relation named after a table in the database schema provided to the program `RestBuilder`.
 * Your edits are preserved during updates given they follow::
 *      METHODS SHOULD ONLY BE STATIC and may be reordered during generation.
 *      FUNCTIONS MUST NOT EXIST outside the class. (methods and functions are not the same.)
 *      IMPORTED CLASSED AND FUNCTIONS ARE ALLOWED though maybe reordered.
 *      ADDITIONAL CONSTANTS of any kind ARE NOT ALLOWED.
 *      ADDITIONAL CLASS MEMBER VARIABLES are NOT ALLOWED.
 *
 * When creating static member functions which require persistent variables, consider making them static members of that 
 *  static method.
 */
class Carbon_Location_References extends Rest implements iRestNoPrimaryKey
{
    use RestfulValidations;
    
    public const CLASS_NAME = 'Carbon_Location_References';
    public const CLASS_NAMESPACE = 'CarbonPHP\Tables\\';
    public const TABLE_NAME = 'carbon_location_references';
    public const TABLE_PREFIX = '';
    
    /**
     * COLUMNS
     * The columns below are a 1=1 mapping to the columns found in carbon_location_references. 
     * Changes, shuch as adding or removing a column, SHOULD be made first in the database. The RestBuilder program will 
     * capture any changes made in MySQL and update this file auto-magically. 
    **/
    public const ENTITY_REFERENCE = 'carbon_location_references.entity_reference'; 

    public const LOCATION_REFERENCE = 'carbon_location_references.location_reference'; 

    public const LOCATION_TIME = 'carbon_location_references.location_time'; 

    /**
     * PRIMARY
     * This could be null for tables without primary key(s), a string for tables with a single primary key, or an array 
     * given composite primary keys. The existence and amount of primary keys of the will also determine the interface 
     * aka method signatures used.
    **/
    public const PRIMARY = null;

    /**
     * COLUMNS
     * This is a convience constant for accessing your data after it has be returned from a rest operation. It is needed
     * as Mysql will strip away the tablename we have explicitly provided to each column (to help with join statments).
     * Thus, accessing your return values might look something like:
     *      $return[self::COLUMNS[self::EXAMPLE_COLUMN_ONE]]
    **/ 
    public const COLUMNS = [
        'carbon_location_references.entity_reference' => 'entity_reference','carbon_location_references.location_reference' => 'location_reference','carbon_location_references.location_time' => 'location_time',
    ];

    public const PDO_VALIDATION = [
        'carbon_location_references.entity_reference' => ['binary', 'PDO::PARAM_STR', '16'],'carbon_location_references.location_reference' => ['binary', 'PDO::PARAM_STR', '16'],'carbon_location_references.location_time' => ['datetime', 'PDO::PARAM_STR', ''],
    ];
     
    /**
     * REFRESH_SCHEMA
     * These directives should be designed to maintain and update your team's schema &| database &| table over time. 
     * It is RECOMMENDED that ALL changes you make in your local env be programmatically coded out in callables such as 
     * the 'tableExistsOrExecuteSQL' method call below. If a PDO exception is thrown with `$e->getCode()` equal to 42S02 
     * or 1049 CarbonPHP will attempt to REFRESH the full database with with all directives in all tables. If possible 
     * keep table specific procedures in it's respective restful-class table file. Check out the 'tableExistsOrExecuteSQL' 
     * method in the parent class to see a more abstract procedure.
     * Each directive MUST be designed to run multiple times without failure.
     */
    public const REFRESH_SCHEMA = [
        [self::class => 'tableExistsOrExecuteSQL', self::TABLE_NAME, self::REMOVE_MYSQL_FOREIGN_KEY_CHECKS .
                        PHP_EOL . self::CREATE_TABLE_SQL . PHP_EOL . self::REVERT_MYSQL_FOREIGN_KEY_CHECKS]
    ]; 
    
    /**
     * REGEX_VALIDATION
     * Regular Expression validations will run before and recommended over PHP_VALIDATION.
     * It is a 1 to 1 column regex relation with fully regex for preg_match_all(). This regex must satisfy the condition 
     *        1 > preg_match_all(self::$compiled_regex_validations[$column], $value, ...
     * 
     * Table generated column constants must be used. 
     *       self::EXAMPLE_COLUMN_NAME => '#^[A-F0-9]{20,35}$#i'
     *
     * @link https://regexr.com
     * @link https://php.net/manual/en/function.preg-match-all.php
     */
    public const REGEX_VALIDATION = []; 
     
     
    /**
     * PHP_VALIDATION
     * PHP validations works as follows:
     * @note regex validation is always step #1 and should be favored over php validations.
     *  Syntax ::
     *      [Example_Class::class => 'disallowPublicAccess', (optional) ...$rest]
     *      self::EXAMPLE_COLUMN => [Example_Class::class => 'exampleOtherMethod', (optional) ...$rest]
     *
     *  Callables defined above MUST NOT RETURN FALSE. Moreover; return values are ignored so `): void {` may be used. 
     *  array_key_first() must return a fully qualified class namespace. In the example above Example_Class would be a
     *  class defined in our system. PHP's `::class` appended to the end will return the fully qualified namespace. Note
     *  this will require the custom import added to the top of the file. You can allow your editor to add these for you
     *  as the RestBuilder program will capture, preserve, and possibly reorder the imports. The value of the first key 
     *  MUST BE the exact name of a member-method of that class. Typically validations are defined in the same class 
     *  they are used ('self::class') though it is useful to export more dynamic functions. The $rest variable can be 
     *  used to add additional arguments to the request. RESTFUL INTERNAL ARGUMENTS will be passed before any use defined
     *  variables after the first key value pair. Only array values will be passed to the method. Thus, additional keys 
     *  listed in the array will be ignored. Take for example::
     *
     *      [ self::class => 'validateUnique', self::class, self::EXAMPLE_COLUMN]
     *  The above is defined in RestfulValidations::class. 
     *      RestfulValidations::validateUnique(string $columnValue, string $className, string $columnName)
     *  Its definition is with a trait this classes inherits using `use` just after the `class` keyword. 
     * 
     *   What is the RESTFUL lifecycle?
     *      Regex validations are done first on any main query; sub-queries are treated like callbacks which get run 
     *      during the main queries invocation. The main query is 'paused' while the sub-query will compile and validate.
     *      Validations across tables are concatenated on joins and sub-queries. All callbacks will be run across any 
     *       table joins.
     *      
     *   What are the RESTFUL INTERNAL ARGUMENTS? (The single $arg string or array passed before my own...)
     *      REST_REQUEST_PREPROCESS_CALLBACKS ::   
     *           PREPROCESS::
     *              Methods defined here will be called at the beginning of every request. 
     *              Each method will be passed ( & self::$REST_REQUEST_PARAMETERS ) by reference so changes can be made pre-request.
     *              Method validations under the main 'PREPROCESS' key will be run first, while validations specific to 
     *              ( GET | POST | PUT | DELETE )::PREPROCESS will be run directly after.
     *
     *           FINAL:: 
     *              Each method will be passed the final ( & $SQL ), which may be a sub-query, by reference.
     *              Modifying the SQL string will effect the parent function. This can have disastrous effects.
     *
     *           COLUMN::
     *              Preformed while a column is being parsed in a query. The first column validations to run.
     *              Each column specific method under PREPROCESS will be passed nothing from rest. 
     *              Each method will ONLY be RUN ONCE regardless of how many times the column has been seen. 
     *
     *      COLUMN::
     *           Column validations are only run when they have been parsed in the query. Global column validations maybe
     *            RUN MULTIPLE TIMES if the column is used multiple times in a single restful query. 
     *           If you have a column that is used multiple times the validations will run for each occurrence.
     *           Column validation can mean many thing. There are three possible scenarios in which your method 
     *            signature would change. For this reason it is more common to use method ( GET | POST ... ) wise column validations.
     *              *The signature required are as follows:
     *                  Should the column be...
     *                      SELECTED:  
     *                          In a select stmt no additional parameters will be passed.
     *                      
     *                      ORDERED BY: (self::ASC | self::DESC)
     *                          The $operator will be passed to the method.
     *  
     *                      JOIN STMT:
     *                          The $operator followed by the $value will be passed. 
     *                          The operator could be :: >,<,<=,<,=,<>,=,<=>
     *
     *      REST_REQUEST_FINNISH_CALLBACKS::
     *          PREPROCESS::
     *              These callbacks are called after a successful PDOStatement->execute() but before Database::commit().
     *              Each method will be passed ( GET => &$return, DELETE => &$remove, PUT => &$returnUpdated ) by reference. 
     *              POST will BE PASSED NULL.          
     *
     *          FINAL::
     *              Run directly after method specific [FINAL] callbacks.
     *              The final, 'final' callback set. After these run rest will return. 
     *              Each method will be passed ( GET => &$return, DELETE => &$remove, PUT => &$returnUpdated ) by reference. 
     *              POST will BE PASSED NULL. 
     *
     *          COLUMN::
     *              These callables will be run after the [( GET | POST | PUT | DELETE )][FINAL] methods.
     *              Directly after, the [REST_REQUEST_FINNISH_CALLBACKS][FINAL] will run. 
     *              
     *
     *      (POST|GET|PUT|DELETE)::
     *          PREPROCESS::
     *              Methods run after any root 'REST_REQUEST_PREPROCESS_CALLBACKS'
     *              Each method will not be passed any argument from system. User arguments will be directly reflected.
     *
     *          COLUMN::
     *              Methods run after any root column validations, the last of the PREPROCESS column validations to run.
     *              Based on the existences and number of primary key(s), the signature will change. 
     *               See the notes on the base column validations as signature of parameters may change. 
     *              It is not possible to directly define a method->column specific post processes. This can be done by
     *               dynamically pairing multiple method processes starting with one here which signals a code routine 
     *               in a `finial`-ly defined method. The FINAL block specific to the method would suffice. 
     *
     *          FINAL::
     *              Passed the ( & $return )  
     *              Run before any other column validation 
     *
     *  Be aware the const: self::DISALLOW_PUBLIC_ACCESS = [self::class => 'disallowPublicAccess'];
     *  could be used to replace each occurrence of 
     *          [self::class => 'disallowPublicAccess', self::class]
     *  though would loose information as self::class is a dynamic variable which must be used in this class given 
     *  static and constant context. 
     *  @version ^9
     */
 
    public const PHP_VALIDATION = [ 
        [self::DISALLOW_PUBLIC_ACCESS],
        self::GET => [ self::DISALLOW_PUBLIC_ACCESS ],    
        self::POST => [ self::DISALLOW_PUBLIC_ACCESS ],    
        self::PUT => [ self::DISALLOW_PUBLIC_ACCESS ],    
        self::DELETE => [ self::DISALLOW_PUBLIC_ACCESS ],    
    ]; 
   
    /**
     * CREATE_TABLE_SQL is autogenerated and should not be manually updated. Make changes in MySQL and regenerate using
     * the RestBuilder program.
     */
    public const CREATE_TABLE_SQL = /** @lang MySQL */ <<<MYSQL
    CREATE TABLE `carbon_location_references` (
  `entity_reference` binary(16) NOT NULL,
  `location_reference` binary(16) NOT NULL,
  `location_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `carbon_location_references_carbons_entity_pk_fk` (`entity_reference`),
  KEY `carbon_location_references_carbons_entity_pk_fk_2` (`location_reference`),
  CONSTRAINT `carbon_location_references_carbons_entity_pk_fk` FOREIGN KEY (`entity_reference`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `carbon_location_references_carbons_entity_pk_fk_2` FOREIGN KEY (`location_reference`) REFERENCES `carbons` (`entity_pk`) ON DELETE CASCADE ON UPDATE CASCADE
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
MYSQL;
   
   

    
    /**
     * @deprecated Use the class constant CREATE_TABLE_SQL directly
     * @return string
     */
    public static function createTableSQL() : string {
        return self::CREATE_TABLE_SQL;
    }
    
    /**
    * Currently nested aggregation is not supported. It is recommended to avoid using 'AS' where possible. Sub-selects are 
    * allowed and do support 'as' aggregation. Refer to the static subSelect method parameters in the parent `Rest` class.
    * All supported aggregation is listed in the example below. Note while the WHERE and JOIN members are syntactically 
    * similar, and are moreover compiled through the same method, our aggregation is not. Please refer to this example 
    * when building your queries. By design, queries using subSelect are only allowed internally. Public Sub-Selects may 
    * be given an optional argument with future releases but will never default to on. Thus, you external API validation
    * need only validate for possible table joins. In many cases sub-selects can be replaces using simple joins, this is
    * highly recommended.
    *
    *   $argv = [
    *       Rest::SELECT => [
    *              'table_name.column_name',                            // bad, dont pass strings manually. Use Table Constants instead.
    *              self::EXAMPLE_COLUMN_ONE,                            // good, 
    *              [self::EXAMPLE_COLUMN_TWO, Rest::AS, 'customName'],
    *              [Rest::COUNT, self::EXAMPLE_COLUMN_TWO, 'custom_return_name_using_as'],
    *              [Rest::GROUP_CONCAT, self::EXAMPLE_COLUMN_THREE], 
    *              [Rest::MAX, self::EXAMPLE_COLUMN_FOUR], 
    *              [Rest::MIN, self::EXAMPLE_COLUMN_FIVE], 
    *              [Rest::SUM, self::EXAMPLE_COLUMN_SIX], 
    *              [Rest::DISTINCT, self::EXAMPLE_COLUMN_SEVEN], 
    *              ANOTHER_EXAMPLE_TABLE::subSelect($primary, $argv, $as, $pdo, $database)
    *       ],
    *       Rest::WHERE => [
    *              
    *              self::EXAMPLE_COLUMN_NINE => 'Value To Constrain',                       // self::EXAMPLE_COLUMN_NINE AND           
    *              'Defaults to boolean AND grouping' => 'Nesting array switches to OR',    // ''='' AND 
    *              [
    *                  'Column Name' => 'Value To Constrain',                                  // ''='' OR
    *                  'This array is OR'ed together' => 'Another sud array would `AND`'       // ''=''
    *                  [ etc... ]
    *              ],
    *              'last' => 'whereExample'                                                  // AND '' = ''
    *        ],
    *        Rest::JOIN => [
    *            Rest::INNER => [
    *                Carbon_Users::CLASS_NAME => [
    *                    'Column Name' => 'Value To Constrain',
    *                    'Defaults to AND' => 'Nesting array switches to OR',
    *                    [
    *                       'Column Name' => 'Value To Constrain',
    *                       'This array is OR'ed together' => 'value'
    *                       [ 'Another sud array would `AND`ed... ]
    *                    ],
    *                    [ 'Column Name', Rest::LESS_THAN, 'Another Column Name']           // NOTE the Rest::LESS_THAN
    *                ]
    *            ],
    *            Rest::LEFT_OUTER => [
    *                Example_Table::CLASS_NAME => [
    *                    Location::USER_ID => Users::ID,
    *                    Location_References::ENTITY_KEY => $custom_var,
    *                   
    *                ],
    *                Example_Table_Two::CLASS_NAME => [
    *                    Example_Table_Two::ID => Example_Table_Two::subSelect($primary, $argv, $as, $pdo, $database)
    *                    ect... 
    *                ]
    *            ]
    *        ],
    *        Rest::PAGINATION => [
    *              Rest::PAGE => (int) 0, // used for pagination which equates to 
    *                  // ... LIMIT ' . (($argv[self::PAGINATION][self::PAGE] - 1) * $argv[self::PAGINATION][self::LIMIT]) 
    *                  //       . ',' . $argv[self::PAGINATION][self::LIMIT];
    *              
    *              Rest::LIMIT => (int) 90, // The maximum number of rows to return,
    *                       setting the limit explicitly to 1 will return a key pair array of only the
    *                       singular result. SETTING THE LIMIT TO NULL WILL ALLOW INFINITE RESULTS (NO LIMIT).
    *                       The limit defaults to 100 by design.
    *
    *               Rest::ORDER => [self::EXAMPLE_COLUMN_TEN => Rest::ASC ],  // i.e.  'username' => Rest::DESC
    *         ],
    *   ];
    *
    *
    * @param array $return
    * @param array $argv
    * @noinspection DuplicatedCode - possible as this is generated
    * @generated
    * @throws PublicAlert|PDOException|JsonException
    * @return bool
    */
    public static function Get(array &$return, array $argv = []): bool
    {
        self::startRest(self::GET, $return, $argv );

        $pdo = self::database();

        $sql = self::buildSelectQuery(null, $argv, '', $pdo);
        
        self::jsonSQLReporting(func_get_args(), $sql);
        
        self::postpreprocessRestRequest($sql);
        
        $stmt = $pdo->prepare($sql);

        self::bind($stmt);

        if (!$stmt->execute()) {
            self::completeRest();
            return self::signalError('The REST generated PDOStatement failed to execute with error :: ' . json_encode($stmt->errorInfo(), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
        }

        $return = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (isset($argv[self::PAGINATION][self::LIMIT]) && $argv[self::PAGINATION][self::LIMIT] === 1 && count($return) === 1) {
            $return = isset($return[0]) && is_array($return[0]) ? $return[0] : $return;
        }

        self::postprocessRestRequest($return);
        
        self::completeRest();
        
        return true;
    }

    /**
     * @param array $data 
     * @return bool|string
     * @generated
     * @throws PublicAlert|PDOException|JsonException
     */
    public static function Post(array $data = []): bool
    {   
        self::startRest(self::POST, [], $data);
    
        foreach ($data as $columnName => $postValue) {
            if (!array_key_exists($columnName, self::PDO_VALIDATION)) {
                return self::signalError("Restful table could not post column $columnName, because it does not appear to exist.");
            }
        } 
        
        $sql = 'INSERT INTO carbon_location_references (entity_reference, location_reference) VALUES ( UNHEX(:entity_reference), UNHEX(:location_reference))';

        $pdo = self::database();
        
        if (!$pdo->inTransaction()) {
            $pdo->beginTransaction();
        }

        self::jsonSQLReporting(func_get_args(), $sql);

        self::postpreprocessRestRequest($sql);

        $stmt = self::database()->prepare($sql);
        
        if (!array_key_exists('carbon_location_references.entity_reference', $data)) {
            return self::signalError('Required argument "carbon_location_references.entity_reference" is missing from the request.');
        }
        $entity_reference = $data['carbon_location_references.entity_reference'];
        $ref='carbon_location_references.entity_reference';
        $op = self::EQUAL;
        if (!self::validateInternalColumn(self::POST, $ref, $op, $entity_reference)) {
            return self::signalError('Your custom restful api validations caused the request to fail on column \'carbon_location_references.entity_reference\'.');
        }
        $stmt->bindParam(':entity_reference',$entity_reference, PDO::PARAM_STR, 16);
        
        if (!array_key_exists('carbon_location_references.location_reference', $data)) {
            return self::signalError('Required argument "carbon_location_references.location_reference" is missing from the request.');
        }
        $location_reference = $data['carbon_location_references.location_reference'];
        $ref='carbon_location_references.location_reference';
        $op = self::EQUAL;
        if (!self::validateInternalColumn(self::POST, $ref, $op, $location_reference)) {
            return self::signalError('Your custom restful api validations caused the request to fail on column \'carbon_location_references.location_reference\'.');
        }
        $stmt->bindParam(':location_reference',$location_reference, PDO::PARAM_STR, 16);
        
        if (array_key_exists('carbon_location_references.location_time', $data)) {
            return self::signalError('The column \'carbon_location_references.location_time\' is set to default to CURRENT_TIMESTAMP. The Rest API does not allow POST requests with columns explicitly set whose default is CURRENT_TIMESTAMP. You can remove to the default in MySQL or the column \'carbon_location_references.location_time\' from the request.');
        }
        
        if (!$stmt->execute()) {
            self::completeRest();
            return self::signalError('The REST generated PDOStatement failed to execute with error :: ' . json_encode($stmt->errorInfo(), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
        }
        
        self::prepostprocessRestRequest();
        
        if (self::$commit && !Database::commit()) {
            return self::signalError('Failed to store commit transaction on table carbon_location_references');
        }
        
        self::postprocessRestRequest();
        
        self::completeRest();
        
        return true;  
    }
    
    /**
    * 
    * 
    *  Syntax should be as follows.
    *  $argv = [
    *       Rest::UPDATE => [
    *              ...
    *       ],
    *       Rest::WHERE => [
    *              ...
    *       ]
    * 
    * @param array $returnUpdated - will be merged with with array_merge, with a successful update. 
    
    * @param array $argv 
    * @generated
    * @throws PublicAlert|PDOException|JsonException
    * @return bool - if execute fails, false will be returned and $returnUpdated = $stmt->errorInfo(); 
    */
    public static function Put(array &$returnUpdated,  array $argv = []) : bool
    {
        self::startRest(self::PUT, $returnUpdated, $argv);
        
        $where = [];

        if (array_key_exists(self::WHERE, $argv)) {
            $where = $argv[self::WHERE];
            unset($argv[self::WHERE]);
        }
        
        if (array_key_exists(self::UPDATE, $argv)) {
            $argv = $argv[self::UPDATE];
        }
        
        if (false === self::$allowFullTableUpdates && empty($where)) {
            return self::signalError('Restful tables which have no primary key must be updated using conditions given to $argv[self::WHERE] and values to be updated given to $argv[self::UPDATE]. No WHERE attribute given. To bypass this set `self::$allowFullTableUpdates = true;` during the PREPROCESS events, or just directly before this request.');
        }
        
        if (empty($argv)) {
            return self::signalError('Restful tables which have no primary key must be updated using conditions given to $argv[self::WHERE] and values to be updated given to $argv[self::UPDATE]. No UPDATE attribute given.');
        }
        
        foreach ($argv as $key => &$value) {
            if (!array_key_exists($key, self::PDO_VALIDATION)){
                return self::signalError('Restful table could not update column $key, because it does not appear to exist. Please re-run RestBuilder if you beleive this is incorrect.');
            }
            $op = self::EQUAL;
            if (!self::validateInternalColumn(self::PUT, $key, $op, $value)) {
                return self::signalError('Your custom restful api validations caused the request to fail on column \'carbon_location_references.\'.');
            }
        }
        unset($value);

        $sql = /** @lang MySQLFragment */ 'UPDATE carbon_location_references SET '; // intellij cant handle this otherwise

        $set = '';

        if (array_key_exists('carbon_location_references.entity_reference', $argv)) {
            $set .= 'entity_reference=UNHEX(:entity_reference),';
        }
        if (array_key_exists('carbon_location_references.location_reference', $argv)) {
            $set .= 'location_reference=UNHEX(:location_reference),';
        }
        if (array_key_exists('carbon_location_references.location_time', $argv)) {
            $set .= 'location_time=:location_time,';
        }
        
        $sql .= substr($set, 0, -1);

        $pdo = self::database();
        
        if (!$pdo->inTransaction()) {
            $pdo->beginTransaction();
        }

        if (false === self::$allowFullTableUpdates || !empty($where)) {
            $sql .= ' WHERE ' . self::buildBooleanJoinConditions(self::PUT, $where, $pdo);
        }
        
        self::jsonSQLReporting(func_get_args(), $sql);

        self::postpreprocessRestRequest($sql);

        $stmt = $pdo->prepare($sql);

        if (array_key_exists('carbon_location_references.entity_reference', $argv)) { 
            $entity_reference = $argv['carbon_location_references.entity_reference'];
            $ref = 'carbon_location_references.entity_reference';
            $op = self::EQUAL;
            if (!self::validateInternalColumn(self::PUT, $ref, $op, $entity_reference)) {
                return self::signalError('Your custom restful api validations caused the request to fail on column \'entity_reference\'.');
            }
            $stmt->bindParam(':entity_reference',$entity_reference, PDO::PARAM_STR, 16);
        }
        if (array_key_exists('carbon_location_references.location_reference', $argv)) { 
            $location_reference = $argv['carbon_location_references.location_reference'];
            $ref = 'carbon_location_references.location_reference';
            $op = self::EQUAL;
            if (!self::validateInternalColumn(self::PUT, $ref, $op, $location_reference)) {
                return self::signalError('Your custom restful api validations caused the request to fail on column \'location_reference\'.');
            }
            $stmt->bindParam(':location_reference',$location_reference, PDO::PARAM_STR, 16);
        }
        if (array_key_exists('carbon_location_references.location_time', $argv)) { 
            $stmt->bindValue(':location_time',$argv['carbon_location_references.location_time'], PDO::PARAM_STR);
        }
        
        self::bind($stmt);

        if (!$stmt->execute()) {
            self::completeRest();
            return self::signalError('The REST generated PDOStatement failed to execute with error :: ' . json_encode($stmt->errorInfo(), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
        }
        
        if (!$stmt->rowCount()) {
            return self::signalError('Failed to find the target row.');
        }
        
        $argv = array_combine(
            array_map(
                static fn($k) => str_replace('carbon_location_references.', '', $k),
                array_keys($argv)
            ),
            array_values($argv)
        );

        $returnUpdated = array_merge($returnUpdated, $argv);
        
        self::prepostprocessRestRequest($returnUpdated);
        
        if (self::$commit && !Database::commit()) {
            return self::signalError('Failed to store commit transaction on table carbon_location_references');
        }
        
        self::postprocessRestRequest($returnUpdated);
        
        self::completeRest();
        
        return true;
    }

    /**
    * @param array $remove
    * @param array $argv
    * @generated
    * @noinspection DuplicatedCode
    * @throws PublicAlert|PDOException|JsonException
    * @return bool
    */
    public static function Delete(array &$remove, array $argv = []) : bool
    {
        self::startRest(self::DELETE, $remove, $argv);
        
        $pdo = self::database();
        
        $sql =  /** @lang MySQLFragment */ 'DELETE FROM carbon_location_references ';
        
        if (false === self::$allowFullTableDeletes && empty($argv)) {
            return self::signalError('When deleting from tables with out a primary key additional arguments must be provided.');
        } 
        
        if (!empty($argv)) {
            $sql .= ' WHERE ' . self::buildBooleanJoinConditions(self::DELETE, $argv, $pdo);
        }
        
        if (!$pdo->inTransaction()) {
            $pdo->beginTransaction();
        }
        
        self::jsonSQLReporting(func_get_args(), $sql);

        self::postpreprocessRestRequest($sql);

        $stmt = $pdo->prepare($sql);

        self::bind($stmt);

        if (!$stmt->execute()) {
            self::completeRest();
            return self::signalError('The REST generated PDOStatement failed to execute with error :: ' . json_encode($stmt->errorInfo(), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
        }

        $remove = [];
        
        self::prepostprocessRestRequest($remove);
        
        if (self::$commit && !Database::commit()) {
           return self::signalError('Failed to store commit transaction on table carbon_location_references');
        }
        
        self::postprocessRestRequest($remove);
        
        self::completeRest();
        
        return true;
    }
}
