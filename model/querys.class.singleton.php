<?php
//////
class querys {
    //////
    private $result;
    private $error;
    private $resolve;
    private $query;
    private $where;
    private $join;
    private $order;
    private $limit;
    private $transactions;

    public function select($values, $table, $distinct = false, $force = false) {
        $select = "SELECT ";
        if ($distinct == true) {
            $select .= "DISTINCT ";
        }// end_if
        if ($values[0] != '*') {
            for ($i = 0; $i < sizeof($values); $i++) {
                $values[$i] = $table . "." . $values[$i];
            }// end_for
        }
        $this -> query = $select . implode(',', $values) . " FROM " . $table;
        //////
        return $this;
    }// end_select

    public function update($values, $table, $quotes = false) {
        $typedQuery = "UPDATE $table SET ";
        $cont = 0;
        //////
        foreach ($values as $key => $row) {
            if ($quotes) {
                $row = "'" . $row . "'";
            }
            if ($cont == 0) {
                $typedQuery = $typedQuery . $key . " = " . $row;
            }else {
                $typedQuery = $typedQuery . ", $key = " . $row;
            }// end_else
            $cont++;
        }// end_foreach
        $this -> query = $typedQuery;
        //////
        return $this;
    }// end_update

    public function delete($table) {
        $this -> query = "DELETE FROM $table";
        //////
        return $this;
    }// end_delete

    public function insert($values, $table) {
        $insert = "INSERT INTO $table";
        $cont = 0;
        foreach ($values as $row) {
            if ($cont == 0) {
                $keys = array_keys($row);
                $insert = $insert . " (" . implode(',', $keys) . ") VALUES";
            }// end_cont
            $insert = $insert . " ('" . implode("', '", array_values($row)) . "')";
            $this -> query = $insert;
            $cont++;
        }// end_foreach
        return $this;
    }// insert

    public function where($values, $mode = 'AND', $operator = "=", $force = false) {
        $cont = 0;
        $typedQuery = " WHERE ";
        //////
        if (!empty($this -> where) || $force) {
            $typedQuery = "";
            $cont = 1;
        }// end_if
        if (!empty($this -> query)) {
            if (($mode == 'AND') || ($mode == 'OR')) {
                foreach ($values as $key => $row) {
                    $strValues = implode("', '", $row);
                    if (sizeof($row) == 1) {
                        if ($cont == 0) {
                            $typedQuery = $typedQuery . "$key $operator '$strValues'";
                        }else {
                            $typedQuery = $typedQuery . " $mode $key $operator '$strValues'";
                        }// end_else
                    }else {
                        if ($cont == 0) {
                            $typedQuery = $typedQuery . "$key IN ('$strValues')";
                        }else {
                            $typedQuery = $typedQuery . " $mode $key IN ('$strValues')";
                        }// end_else
                    }// end_else
                    //////
                    $cont++;
                }// end_foreach
                $this -> where = $this -> where . $typedQuery;
            }// end_if
        }// end_if
        //////
        return $this;
    }// end_where

    public function join($values, $join) {
        foreach ($values as $row) {
            $keys = array_keys($row);
            $this -> join = $this -> join . " $join JOIN $keys[0] ON $keys[0]" . "." . $row[$keys[0]] . " = $keys[1]" . "." . $row[$keys[1]];
            // echo '<script>';
            // echo 'console.log('. json_encode( " $join JOIN $keys[0] ON $keys[0]" . "." . $row[$keys[0]] . " = $keys[1]" . "." . $row[$keys[1]] ) .')';
            // echo '</script>';
        }// end_foreach
        //////
        return $this;
    }// end_join

    public function order($values, $type = "ASC") {
        $this -> order = " ORDER BY " . implode(', ', $values) . " $type";
        //////
        return $this;
    }// end_order
    public function group($values) {
        $this -> group = " GROUP BY " . $values;
        //////
        return $this;
    }

    public function limit($maxItems, $totalItems = false) {
        $limit = " LIMIT ";
        if ($totalItems == false) {
            $limit = $limit . "$maxItems";
        }else {
            $limit = $limit . "$maxItems, $totalItems";
        }// end_else
        //////
        $this -> limit = $limit;
        return $this;
    }// end_limit

    public function manual($typedQuery) {
        $this -> query = $this -> query . $typedQuery;
        //////
        return $this;
    }// end_manual

    public function count() {
        $this -> resolve = mysqli_num_rows($this -> result);
        //////
        return $this;
    }// end_count

    public function execute($transaction = false) {
        if (!empty($this -> join)) {
            $this -> query = $this -> query . $this -> join;
            $this -> join = "";
        }
        if (!empty($this -> where)) {
            $this -> query = $this -> query . $this -> where;
            $this -> where = "";
        }
        if (!empty($this -> order)) {
            $this -> query = $this -> query . $this -> order;
            $this -> order = "";
        }
        if (!empty($this -> limit)) {
            $this -> query = $this -> query . $this -> limit;
            $this -> limit = "";
        }

        $connection = db::enable();
        if ($transaction) {
            mysqli_autocommit($connection, false);
            foreach ($this -> transactions as $row) {
                mysqli_query($connection, $row);
            }// end_foreach
            if (mysqli_commit($connection)) {
                $this -> result = true;
            }else {
                $this -> result = false;
            }// end_else
        }else {
            $this -> result = mysqli_query($connection, $this -> query);
            $this -> error = mysqli_error($connection);
        }// end_else
        db::close($connection);
        //////
        return $this;
    }// end_execute

    public function queryToArray($force = false) {
        $values = array();
        //////
        if (mysqli_num_rows($this -> result) > 0) {
            while ($row = mysqli_fetch_assoc($this -> result)) {
                if ((mysqli_num_rows($this -> result) > 1) || ($force == true)) {
                    $values[] = $row;
                }else {
                    $values = $row;
                }// end_else
            }// end_while
        }// end_if
        //////
        $this -> resolve = $values;
        return $this;
    }// end_queryToArray

    public function toJSON() {
        if (!empty($this -> getResolve())) {
            $this -> resolve = json_encode($this -> resolve);
        }else if ($this -> getResult()) {
            $this -> resolve = json_encode($this -> result);
        }else {
            $this -> resolve = $this -> error;
        }// end_else
        //////
        return $this;
    }// end_toJSON

    

    public function getResolve() {
        return $this -> resolve;
    }//end_getResolve

    public function getError() {
        return $this -> error;
    }// end_getError

    public function getQuery() {
        return $this -> query;
    }// end_getQuery

    public function getResult() {
        return $this -> result;
    }// end_getResult

    public function getTransactions() {
        return $this -> transactions;
    }// end_getTransactions

    public function setTransaction() {
        if (empty($this -> transactions)) {
            $this -> transactions = [];
        }// end_if
        $this -> transactions[] = $this -> query;
        $this -> query = "";
        //////
        return $this;
    }// end_setTransaction

    public function setQuery($query) {
        $this -> query = $query;
    }// end_setQuery
}// end_Querys