<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Validator;
use Session;
use App\UserData;
use Illuminate\Routing\Controller as BaseController;


class UserController extends BaseController
{
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

public function UserList(){
    $userdata = UserData::select('users.*',\DB::RAW("TIMESTAMPDIFF(YEAR, users.date_of_join, users.date_of_leave) AS year"),\DB::RAW("TIMESTAMPDIFF(MONTH, users.date_of_join, users.date_of_leave)%12 AS month"),\DB::RAW("FLOOR(TIMESTAMPDIFF(DAY, users.date_of_join, users.date_of_leave)%30.4375) AS day"),\DB::RAW("TIMESTAMPDIFF(YEAR, users.date_of_join, current_date()) AS still_year"),\DB::RAW("TIMESTAMPDIFF(MONTH, users.date_of_join, current_date())%12 AS still_month"),\DB::RAW("FLOOR(TIMESTAMPDIFF(DAY, users.date_of_join, current_date())%30.4375) AS still_day"))->orderBy('id','DESC')->get();

         $user_image_base_path = base_path().'/public/user_avatar/';
         $user_image_public_path = url('/').'/public/user_avatar/';

        $this->arr_view_data['users']       = $userdata;
        $this->arr_view_data['image_path']  = $user_image_base_path;
        $this->arr_view_data['public_image_path'] = $user_image_public_path;
       
		
		return view('index',$this->arr_view_data);
}

public function storeUser(Request $request){
    $arr_rules   =    array();
    $status         = false;
    $input = $request->all();
    $arr_rules['fname']="required";
    $arr_rules['email']="required";
    $arr_rules['doj']="required";
    $arr_rules['dol'] = 'required_without:stillwork';
    $arr_rules['stillwork'] = 'required_without:dol';
    $arr_rules['image']   = "required";
    $attributeNames = array(
        'fname' => 'Full Name',
        'email' => 'Email',
        'doj' => 'Date of Joining',    
        'dol' => 'Date of Leaving', 
        'stillwork' => 'Still Working',     
     );

    $validator = Validator::make($request->all(), $arr_rules);
    $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            Session::flash('error', 'Please fill all required fields');
            return back()->withErrors($validator)->withInput();
        }
        $doj= $request->input('doj');
        $dol= $request->input('dol');
        
        $join_date =NULL;
        $leave_date=NULL;
        if ($doj!='') {
            $join_date = date('Y-m-d', strtotime($doj));
        }
        if ($dol!='') {
            $leave_date = date('Y-m-d', strtotime($dol));
        }

        $user_image_base_path = base_path().'/public/user_avatar/';

        if ($request->hasFile('image')) 
            {
            $file          = $request->file('image');
            
                $filename        = $file->getClientOriginalName();
                $extension       = $file->getClientOriginalExtension();

                if(in_array($extension,['png','jpg','jpeg']))
                {
                    $file_name       = time().uniqid().'.'.$extension;
                    $picture         = date('His').$file_name;

                    $file->move($user_image_base_path, $picture);

                    $arr_data['image']= $picture;
                    
                }
                else
                {
                    Session::flash('error','Problem occured, while updating Images,Please upload Jpg, Png or jpeg format.');
                    return redirect()->back();
                } 
            }
        
        $arr_data['full_name']= $request->input('fname');
        $arr_data['email']= $request->input('email');
        $arr_data['date_of_join']= $join_date;
        $arr_data['date_of_leave']= $leave_date;
        if ($request->input('stillwork')!='') {
            $arr_data['still_work']= $request->input('stillwork');
        }
    

        $status = UserData::create($arr_data);

   if ($status) {
        Session::flash('success', 'User Created Successfully.');
        return redirect()->back();
	
   }
   else{
    Session::flash('error', 'Error while creating User.');
    return redirect()->back(); 
   }

    
    
}

public function deleteUser($enc_id=''){
    $user_image_base_path = base_path().'/public/user_avatar/';

    $oldImage = UserData::where('id',$enc_id)->first();
    @unlink($user_image_base_path.$oldImage->image);

    $delete = UserData::where('id',$enc_id)->delete();

    if ($delete) {
        Session::flash('success', 'User Deleted Successfully.');
        return redirect()->back();
    }
    else {
        Session::flash('error','error while deleting User');
        return redirect()->back();
    }

}
    
}
