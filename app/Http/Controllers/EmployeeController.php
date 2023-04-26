<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Repositories\employeeRepository;
use Illuminate\Support\Facades\DB;



class EmployeeController extends Controller
{     

    public function __construct(employeeRepository $employeeRepo){
        $this->employeeRepo       = $employeeRepo;   
      
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            
            $validated = $request->validate([
                'username' => 'required',
                'email' => 'required|email|unique:employees,email',
                'phone' => 'required|regex:/^[(+)(1-9)][0-9]{9,14}$/',
                'gender' => 'required',
            ]);
        
        $employee = Employee::create($request->all());
     
            return response()->json([
                'status' => 'success',
                'message' => "Successfully Submitted",
                'data' => $employee],200);   
           
    }
    return view('employees.index');
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $search          = trim($request->input('search')['value']);
        /** search value for datatable  * */
        $offset          = $request->input('start');
        /** offset value * */
        $limit           = $request->input('length');
        /** limits for datatable (show entries) * */
        $order           = $request->input('order')[0]['column'];
        /** order by (column sorted ) * */
        $orderColumn     = $request->input('columns')[$order]['data'];
        $orderDirection  = $request->input('order')[0]['dir'];
        $ordrBy          = $orderColumn . " " . $orderDirection;

        $data = $this->employeeRepo->getEmployeeData($search, $offset, $limit, $order, $ordrBy);

        if (!empty($data))
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $user = Employee::find($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $validated = $request->validate([
            'username' => 'required',
            'email' => 'required|email|',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'gender' => 'required',
        ]);
        
        $employee = Employee::find($id);
        $employee->username = $request->input('username');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->gender = $request->input('gender');
        $employee->update();

      

 
        return response()->json([
            'status' => 'success',
            'message' => "Successfully Submitted",
            'data' => $employee],200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        $user = Employee::find($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
        }
}
