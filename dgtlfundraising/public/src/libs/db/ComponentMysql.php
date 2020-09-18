<?php
namespace Lig\Db;

class ComponentMysql
{
    private $arConn;
    private $isError;
    private $arErrors;
    private $iAffected;

    public function __construct()
    {
        $this->isError = FALSE;
        $this->arErrors = [];
        $this->arConn = $this->_get_conn();
    }

    private function _get_conn()
    {
        //prod
        $config = [
            "server" =>"mysql128int.srv-hostalia.com",
            "database" =>"db4050205_eduardoacevedo",
            "user" =>"u4050205_eduac",
            "password"=>"qTwLKgvz8me",
        ];
        if(APP_ENV==="local")
        {
            $config = [
                "server" =>"localhost",
                "server" =>"127.0.0.1",
                "database" =>"db4050205_eduardoacevedo",
                "user" =>"root",
                "password"=>"1234",
            ];
        }
        return $config;
    }

    private function get_conn_string()
    {
        $arCon["mysql:host"] = (isset($this->arConn["server"])?$this->arConn["server"]:"");
        $arCon["port"] = "3306";
        $arCon["dbname"] = (isset($this->arConn["database"])?$this->arConn["database"]:"");
        //$arCon["ConnectionPooling"] = (isset($this->arConn["pool"])?$this->arConn["pool"]:"0");

        $sString = "";
        foreach($arCon as $sK=>$sV)
            $sString .= "$sK=$sV;";

        return $sString;
    }//get_conn_string

    private function get_rowcol($arResult,$iCol=NULL,$iRow=NULL)
    {
        if(is_int($iCol) || is_int($iRow))
        {
            $arColnames = $arResult[0];
            $arColnames = array_keys($arColnames);
//bug($arColnames);
            $sColname = (isset($arColnames[$iCol])?$arColnames[$iCol]:"");
            if($sColname)
                $arResult = array_column($arResult,$sColname);

            if(isset($arResult[$iRow]))
                $arResult = $arResult[$iRow];
        }
        return $arResult;
    }

    public function query($sSQL,$iCol=NULL,$iRow=NULL)
    {
        try
        {
            $sConn = $this->get_conn_string();
            //https://stackoverflow.com/questions/38671330/error-with-php7-and-sql-server-on-windows
            $oPdo = new \PDO($sConn,$this->arConn["user"],$this->arConn["password"]
                ,[\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
            $oPdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION );
            $oCursor = $oPdo->query($sSQL);
            if($oCursor===FALSE)
            {
                $this->add_error("exec-error: $sSQL");
            }
            else
            {
                //var_dump($stmt);
                $arResult = [];
                while($arRow = $oCursor->fetch(\PDO::FETCH_ASSOC))
                    $arResult[] = $arRow;

                $this->iAffected = count($arResult);

                if($arResult)
                    $arResult = $this->get_rowcol($arResult,$iCol,$iRow);
            }
        }
        catch(PDOException $oE)
        {
            $sMessage = "exception:{$oE->getMessage()}";
            $this->add_error($sMessage);
        }
        return $arResult;
    }//query

    public function exec($sSQL)
    {
        try
        {
            $sConn = $this->get_conn_string();
            //var_dump($sConn);die;
            //https://stackoverflow.com/questions/19577056/using-pdo-to-create-table
            $oPdo = new \PDO($sConn,$this->arConn["user"],$this->arConn["password"]
                ,[\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
            $oPdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION );
            $mxR = $oPdo->exec($sSQL);
            $this->iAffected = $mxR;
            if($mxR===FALSE)
            {
                $this->add_error("exec-error: $sSQL");
            }
            return $mxR;
        }
        catch(PDOException $oE)
        {
            $sMessage = "exception:{$oE->getMessage()}";
            $this->add_error($sMessage);
        }
    }//exec

    private function add_error($sMessage){$this->isError = TRUE;$this->iAffected=-1; $this->arErrors[]=$sMessage;}
    public function is_error(){return $this->isError;}
    public function get_errors(){return $this->arErrors;}
    public function get_error($i=0){return isset($this->arErrors[$i])?$this->arErrors[$i]:NULL;}
    public function show_errors(){echo "<pre>".var_export($this->arErrors,1);}

    public function add_conn($k,$v){$this->arConn[$k]=$v;}
    public function get_affected(){return $this->iAffected;}

}//ComponentMysql