<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class employeeRepository extends Model
{
    protected $db_conn;

    public function __construct(){
        
        $this->db_conn = DB::connection('mysql');     
       
    }
    public function getEmployeeData($search, $offset, $limit, $order, $ordrBy)
    {
        $sql_select = $sql_where = $sql_filter = $sql_result = $sql_rows =  $result_rows = '';
        $sql_select = " id,username,email,phone,gender ";
        $sql_table = "  FROM employees";
        
        
      
            if (isset($search) AND !empty($search)) {
                $sql_where .= " WHERE (
                username like '" . $search . "%'
                or email like '" . $search . "%'
                or phone like '" . $search . "%'
                or gender like '" . $search . "%'
                
                )";
            }
        
        
        $sql_filter = " order by $ordrBy limit $offset,$limit";
        $sql_result = "SELECT $sql_select $sql_table $sql_where $sql_filter";
        $sql_rows = "SELECT count(id) row_count $sql_table $sql_where";
       

            $report_data = $this->db_conn->select(DB::raw($sql_result));
            $result_rows = $this->db_conn->select(DB::raw($sql_rows));

           
           
            if (!empty($result_rows)) {
                $result_rows = $result_rows[0]->row_count;
            } else {
                $result_rows = 0;
            }
        $results = array(
            "draw" => $_REQUEST['draw'],
            "recordsTotal" => count($report_data),
            "recordsFiltered" => $result_rows,
            "data" => $report_data,
           
        );
        return  $results;
    }

   
}