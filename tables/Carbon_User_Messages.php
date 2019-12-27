<?php

namespace CarbonPHP\Tables;

use CarbonPHP\Database;
use CarbonPHP\Interfaces\iRest;


class Carbon_User_Messages extends Database implements iRest
{

    public const MESSAGE_ID = 'message_id';
    public const FROM_USER_ID = 'from_user_id';
    public const TO_USER_ID = 'to_user_id';
    public const MESSAGE = 'message';
    public const MESSAGE_READ = 'message_read';
    public const CREATION_DATE = 'creation_date';

    public const PRIMARY = [
    'message_id',
    ];

    public const COLUMNS = [
        'message_id' => [ 'binary', '2', '16' ],'from_user_id' => [ 'binary', '2', '16' ],'to_user_id' => [ 'binary', '2', '16' ],'message' => [ 'text', '2', '' ],'message_read' => [ 'tinyint', '0', '1' ],'creation_date' => [ 'datetime', '2', '' ],
    ];

    public const VALIDATION = [];


    public static $injection = [];


    public static function jsonSQLReporting($argv, $sql) : void {
        global $json;
        if (!\is_array($json)) {
            $json = [];
        }
        if (!isset($json['sql'])) {
            $json['sql'] = [];
        }
        $json['sql'][] = [
            $argv,
            $sql
        ];
    }

    public static function buildWhere(array $set, \PDO $pdo, $join = 'AND') : string
    {
        $sql = '(';
        $bump = false;
        foreach ($set as $column => $value) {
            if (\is_array($value)) {
                if ($bump) {
                    $sql .= " $join ";
                }
                $bump = true;
                $sql .= self::buildWhere($value, $pdo, $join === 'AND' ? 'OR' : 'AND');
            } else if (array_key_exists($column, self::COLUMNS)) {
                $bump = false;
                if (self::COLUMNS[$column][0] === 'binary') {
                    $sql .= "($column = UNHEX(" . self::addInjection($value, $pdo)  . ")) $join ";
                } else {
                    $sql .= "($column = " . self::addInjection($value, $pdo) . ") $join ";
                }
            } else {
                $bump = false;
                $sql .= "($column = " . self::addInjection($value, $pdo) . ") $join ";
            }
        }
        return rtrim($sql, " $join") . ')';
    }

    public static function addInjection($value, \PDO $pdo, $quote = false) : string
    {
        $inject = ':injection' . \count(self::$injection) . 'buildWhere';
        self::$injection[$inject] = $quote ? $pdo->quote($value) : $value;
        return $inject;
    }

    public static function bind(\PDOStatement $stmt, array $argv) {
   
   /*
    $bind = function (array $argv) use (&$bind, &$stmt) {
            foreach ($argv as $key => $value) {
                
                if (is_numeric($key) && is_array($value)) {
                    $bind($value);
                    continue;
                }
                
                   if (array_key_exists('message_id', $argv)) {
            $message_id = $argv['message_id'];
            $stmt->bindParam(':message_id',$message_id, 2, 16);
        }
                   if (array_key_exists('from_user_id', $argv)) {
            $from_user_id = $argv['from_user_id'];
            $stmt->bindParam(':from_user_id',$from_user_id, 2, 16);
        }
                   if (array_key_exists('to_user_id', $argv)) {
            $to_user_id = $argv['to_user_id'];
            $stmt->bindParam(':to_user_id',$to_user_id, 2, 16);
        }
                   if (array_key_exists('message', $argv)) {
            $stmt->bindValue(':message',$argv['message'], 2);
        }
                   if (array_key_exists('message_read', $argv)) {
            $message_read = $argv['message_read'];
            $stmt->bindParam(':message_read',$message_read, 0, 1);
        }
                   if (array_key_exists('creation_date', $argv)) {
            $stmt->bindValue(':creation_date',$argv['creation_date'], 2);
        }
           
          }
        };
        
        $bind($argv); */

        foreach (self::$injection as $key => $value) {
            $stmt->bindValue($key,$value);
        }

        return $stmt->execute();
    }


    /**
    *
    *   $argv = [
    *       'select' => [
    *                          '*column name array*', 'etc..'
    *        ],
    *
    *       'where' => [
    *              'Column Name' => 'Value To Constrain',
    *              'Defaults to AND' => 'Nesting array switches to OR',
    *              [
    *                  'Column Name' => 'Value To Constrain',
    *                  'This array is OR'ed togeather' => 'Another sud array would `AND`'
    *                  [ etc... ]
    *              ]
    *        ],
    *
    *        'pagination' => [
    *              'limit' => (int) 90, // The maximum number of rows to return,
    *                       setting the limit explicitly to 1 will return a key pair array of only the
    *                       singular result. SETTING THE LIMIT TO NULL WILL ALLOW INFINITE RESULTS (NO LIMIT).
    *                       The limit defaults to 100 by design.
    *
    *              'order' => '*column name* [ASC|DESC]',  // i.e.  'username ASC' or 'username, email DESC'
    *
    *
    *         ],
    *
    *   ];
    *
    *
    * @param array $return
    * @param string|null $primary
    * @param array $argv
    * @return bool
    */
    public static function Get(array &$return, string $primary = null, array $argv) : bool
    {
        self::$injection = [];
        $aggregate = false;
        $group = $sql = '';
        $pdo = self::database();

        $get = $argv['select'] ?? array_keys(self::COLUMNS);
        $where = $argv['where'] ?? [];

        if (array_key_exists('pagination',$argv)) {
            if (!empty($argv['pagination']) && !\is_array($argv['pagination'])) {
                $argv['pagination'] = json_decode($argv['pagination'], true);
            }
            if (array_key_exists('limit',$argv['pagination']) && $argv['pagination']['limit'] !== null) {
                $limit = ' LIMIT ' . $argv['pagination']['limit'];
            } else {
                $limit = '';
            }

            $order = '';
            if (!empty($limit)) {

                $order = ' ORDER BY ';

                if (array_key_exists('order',$argv['pagination']) && $argv['pagination']['order'] !== null) {
                    if (\is_array($argv['pagination']['order'])) {
                        foreach ($argv['pagination']['order'] as $item => $sort) {
                            $order .= "$item $sort";
                        }
                    } else {
                        $order .= $argv['pagination']['order'];
                    }
                } else {
                    $order .= 'message_id ASC';
                }
            }
            $limit = "$order $limit";
        } else {
            $limit = ' ORDER BY message_id ASC LIMIT 100';
        }

        foreach($get as $key => $column){
            if (!empty($sql)) {
                $sql .= ', ';
                if (!empty($group)) {
                    $group .= ', ';
                }
            }
            $columnExists = array_key_exists($column, self::COLUMNS);
            if ($columnExists && self::COLUMNS[$column][0] === 'binary') {
                $sql .= "HEX($column) as $column";
                $group .= $column;
            } elseif ($columnExists) {
                $sql .= $column;
                $group .= $column;
            } else {
                if (!preg_match('#(((((hex|argv|count|sum|min|max) *\(+ *)+)|(distinct|\*|\+|\-|\/| |message_id|from_user_id|to_user_id|message|message_read|creation_date))+\)*)+ *(as [a-z]+)?#i', $column)) {
                    return false;
                }
                $sql .= $column;
                $aggregate = true;
            }
        }

        $sql = 'SELECT ' .  $sql . ' FROM carbon_user_messages';

        if (null === $primary) {
            /** @noinspection NestedPositiveIfStatementsInspection */
            if (!empty($where)) {
                $sql .= ' WHERE ' . self::buildWhere($where, $pdo);
            }
        } else {
        $sql .= ' WHERE  message_id=UNHEX('.self::addInjection($primary, $pdo).')';
        }

        if ($aggregate  && !empty($group)) {
            $sql .= ' GROUP BY ' . $group . ' ';
        }

        $sql .= $limit;

        self::jsonSQLReporting(\func_get_args(), $sql);

        $stmt = $pdo->prepare($sql);

        if (!self::bind($stmt, $argv['where'] ?? [])) {
            return false;
        }

        $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        /**
        *   The next part is so every response from the rest api
        *   formats to a set of rows. Even if only one row is returned.
        *   You must set the third parameter to true, otherwise '0' is
        *   apparently in the self::COLUMNS
        */

        
        if ($primary !== null || (isset($argv['pagination']['limit']) && $argv['pagination']['limit'] === 1 && \count($return) === 1)) {
            $return = isset($return[0]) && \is_array($return[0]) ? $return[0] : $return;
            // promise this is needed and will still return the desired array except for a single record will not be an array
        
        }

        return true;
    }

    /**
    * @param array $argv
    * @return bool|mixed
    */
    public static function Post(array $argv)
    {
        self::$injection = [];
        /** @noinspection SqlResolve */
        $sql = 'INSERT INTO carbon_user_messages (message_id, from_user_id, to_user_id, message, message_read) VALUES ( UNHEX(:message_id), UNHEX(:from_user_id), UNHEX(:to_user_id), :message, :message_read)';

        self::jsonSQLReporting(\func_get_args(), $sql);

        $stmt = self::database()->prepare($sql);

                $message_id = $id = $argv['message_id'] ?? self::beginTransaction('carbon_user_messages');
                $stmt->bindParam(':message_id',$message_id, 2, 16);
                
                    $from_user_id = $argv['from_user_id'];
                    $stmt->bindParam(':from_user_id',$from_user_id, 2, 16);
                        
                    $to_user_id = $argv['to_user_id'];
                    $stmt->bindParam(':to_user_id',$to_user_id, 2, 16);
                        $stmt->bindValue(':message',$argv['message'], 2);
                        
                    $message_read =  $argv['message_read'] ?? '0';
                    $stmt->bindParam(':message_read',$message_read, 0, 1);
                


        return $stmt->execute() ? $id : false;

    }

    /**
    * @param array $return
    * @param string $primary
    * @param array $argv
    * @return bool
    */
    public static function Put(array &$return, string $primary, array $argv) : bool
    {
        self::$injection = [];
        if (empty($primary)) {
            return false;
        }

        foreach ($argv as $key => $value) {
            if (!\array_key_exists($key, self::COLUMNS)){
                return false;
            }
        }

        $sql = 'UPDATE carbon_user_messages ';

        $sql .= ' SET ';        // my editor yells at me if I don't separate this from the above stmt

        $set = '';

            if (array_key_exists('message_id', $argv)) {
                $set .= 'message_id=UNHEX(:message_id),';
            }
            if (array_key_exists('from_user_id', $argv)) {
                $set .= 'from_user_id=UNHEX(:from_user_id),';
            }
            if (array_key_exists('to_user_id', $argv)) {
                $set .= 'to_user_id=UNHEX(:to_user_id),';
            }
            if (array_key_exists('message', $argv)) {
                $set .= 'message=:message,';
            }
            if (array_key_exists('message_read', $argv)) {
                $set .= 'message_read=:message_read,';
            }
            if (array_key_exists('creation_date', $argv)) {
                $set .= 'creation_date=:creation_date,';
            }

        if (empty($set)){
            return false;
        }

        $sql .= substr($set, 0, -1);

        $pdo = self::database();

        $sql .= ' WHERE  message_id=UNHEX('.self::addInjection($primary, $pdo).')';

        self::jsonSQLReporting(\func_get_args(), $sql);

        $stmt = $pdo->prepare($sql);

                   if (array_key_exists('message_id', $argv)) {
            $message_id = $argv['message_id'];
            $stmt->bindParam(':message_id',$message_id, 2, 16);
        }
                   if (array_key_exists('from_user_id', $argv)) {
            $from_user_id = $argv['from_user_id'];
            $stmt->bindParam(':from_user_id',$from_user_id, 2, 16);
        }
                   if (array_key_exists('to_user_id', $argv)) {
            $to_user_id = $argv['to_user_id'];
            $stmt->bindParam(':to_user_id',$to_user_id, 2, 16);
        }
                   if (array_key_exists('message', $argv)) {
            $stmt->bindValue(':message',$argv['message'], 2);
        }
                   if (array_key_exists('message_read', $argv)) {
            $message_read = $argv['message_read'];
            $stmt->bindParam(':message_read',$message_read, 0, 1);
        }
                   if (array_key_exists('creation_date', $argv)) {
            $stmt->bindValue(':creation_date',$argv['creation_date'], 2);
        }

        if (!self::bind($stmt, $argv)){
            return false;
        }

        $return = array_merge($return, $argv);

        return true;

    }

    /**
    * @param array $remove
    * @param string|null $primary
    * @param array $argv
    * @return bool
    */
    public static function Delete(array &$remove, string $primary = null, array $argv) : bool
    {
        if (null !== $primary) {
            return carbons::Delete($remove, $primary, $argv);
        }

        /**
         *   While useful, we've decided to disallow full
         *   table deletions through the rest api. For the
         *   n00bs and future self, "I got chu."
         */
        if (empty($argv)) {
            return false;
        }

        self::$injection = [];
        /** @noinspection SqlResolve */
        $sql = 'DELETE c FROM carbons c 
                JOIN carbon_user_messages on c.entity_pk = follower_table_id';

        $pdo = self::database();

        $sql .= ' WHERE ' . self::buildWhere($argv, $pdo);

        self::jsonSQLReporting(\func_get_args(), $sql);

        $stmt = $pdo->prepare($sql);

        $r = self::bind($stmt, $argv);

        /** @noinspection CallableParameterUseCaseInTypeContextInspection */
        $r and $remove = null;

        return $r;
    }
}