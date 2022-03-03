<?php

namespace App\Helpers;

use App\Models\Setting;

class Helper
{
    public static function successMsg($type, $moduleName, $msg = null)
    /** Type, ModuleName, Message */
    {
        $msgType = "success";
        $moduleName == '' ? 'Data' : $moduleName;
        if ($type == 'insert') {
            $message = "$moduleName Insert Successfully !";
        } elseif ($type == 'update') {
            $message = "$moduleName Update Successfully !";
        } elseif ($type == 'delete') {
            $message = "$moduleName Delete Successfully !";
        } elseif ($type == 'complete') {
            $message = "$moduleName Completed Successfully !";
        }elseif ($type == 'active') {
            $message = "$moduleName Activate Successfully !";
        } elseif ($type == 'in_active') {
            $message = "$moduleName In-Activate  Successfully !";
        } elseif ($type == 'applied') {
            $message = "$moduleName Applied Successfully !";
        } elseif ($type == 'approve') {
            $message = "$moduleName Approved  Successfully !";
        } elseif ($type == 'reject') {
            $message = "$moduleName Rejected Successfully !";
        } elseif ($type == 'reopen') {
            $message = "$moduleName Reopen Successfully !";
        } elseif ($type == 'close') {
            $message = "$moduleName Closed Successfully !";
        } elseif ($type == 'error') {
            $message = "$moduleName Something Went To wrong !";
        }
        else {
            $message = "$moduleName Successfully !";
        }
        session()->flash("message", $message);
    }

        /** Custom Session Message */
        public static function customMsg($msgType, $moduleName, $message)
        {

            session()->flash("message", json_encode([
                'msgType' => $msgType,
                'message' => $message,
                'moduleName' => $moduleName
            ]));
        }

        /* Active Inactive Message */
        public static function activeDeactiveMsg($type, $msg)
        {
            if ($type == 'active') {
                Session()->flash('message', $msg . ' Active Successfully !');
            } else {
                Session()->flash('message', $msg . ' Deactive Successfully !');
            }
        }

}
?>
