<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    /**
     * Display the gallery page
     */
    public function index()
    {
        $imagesPath = public_path('thuhong');
        $images = [];
        
        if (File::exists($imagesPath)) {
            $files = File::files($imagesPath);
            
            foreach ($files as $file) {
                $extension = strtolower($file->getExtension());
                // Chỉ hiển thị các định dạng được trình duyệt hỗ trợ
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $images[] = [
                        'name' => $file->getFilename(),
                        'path' => asset('thuhong/' . $file->getFilename()),
                        'size' => $file->getSize(),
                    ];
                }
            }
        }
        
        return view('gallery.index', compact('images'));
    }
}

