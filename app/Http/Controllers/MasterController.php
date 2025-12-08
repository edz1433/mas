<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Office;
use App\Models\Campus;
use App\Models\User;
use App\Models\DocuFolder;
use App\Models\Document;
use App\Models\Log;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    public function dashboard()
    {
        //Total Teachers
        $totalTeachers = User::where('role', '!=', 'Administrator')->count();

        //Total Students
        $totalStudents =0;

        // Total documents
        $totalDocuments = Document::count();

        // Count documents per folder dynamically
        $documentsByFolder = Document::join('docu_folders', 'documents.folder_id', '=', 'docu_folders.id')
            ->select('docu_folders.folder_name', DB::raw('COUNT(documents.id) as total'))
            ->groupBy('docu_folders.folder_name')
            ->pluck('total', 'folder_name');

        // Recent uploads (latest 5)
        $recentUploads = Log::select("logs.*", 'users.fname', 'users.lname', 'documents.folder_id')
        ->join('users', 'logs.user_id', '=', 'users.id')
        ->leftjoin('documents', 'logs.file_id', '=', 'documents.id')
        ->take(5)
        ->get();

        // Monthly uploads (last 12 months)
        $monthlyDataRaw = Document::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as total")
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();

        $monthlyLabels = $monthlyDataRaw->pluck('month');
        $monthlyData = $monthlyDataRaw->pluck('total');

        return view('home.dashboard', compact(
            'totalTeachers',
            'totalStudents',
            'totalDocuments',
            'documentsByFolder',
            'recentUploads',
            'monthlyLabels',
            'monthlyData'
        ));
    }

    // public function drive()
    // {
    //     $users = User::where('role', 'Staff');
    //     $docFolder = DocuFolder::all()->where('folder_category', 'mainfolder');
        
    //     return view("drive.drive", compact('users', 'docFolder'));
    // }

    public function drive()
    {
        $user = auth()->user(); // Get the current authenticated user

        // Filter users based on role
<<<<<<< HEAD
        $users = User::where('role', '!=', 'Administrator')->get(); 
        $docFolder = DocuFolder::where('folder_category', 'mainfolder')->get();
=======
        $users = User::where('role', 'Staff')->get(); 

        // Filter folders based on the user's role
        if (in_array($user->role, ['Administrator', 'Staff', 'Records Officer'])) {
            $docFolder = DocuFolder::where('folder_category', 'mainfolder')->get();
        } elseif ($user->role === 'Staff_reg') {
            $docFolder = DocuFolder::where('folder_category', 'mainfolder')
                                ->where('folder_name', 'En Route')
                                ->get();
        } else {
            $docFolder = collect(); // No folders for other roles
        }
>>>>>>> 777a96406e44bbe39a6a431482101893bcfb77c3

        return view("drive.drive", compact('users', 'docFolder'));
    }

    public function log()
    {
        $users = User::all();
        $docFolder = DocuFolder::all()->where('folder_category', 'mainfolder');
        
        return view("logs.log", compact('users', 'docFolder'));
    }

    public function logout()
    {
        if (auth()->check()) {
            auth()->logout();
            return redirect()->route('getLogin')->with('success', 'You have been Successfully Logged Out');
        } else {
            return redirect()->route('drive')->with('error', 'No authenticated user to log out');
        }
    }
    
}
