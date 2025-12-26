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
        
        // Các câu tỏ tình ấm áp và ý nghĩa
        $loveMessages = [
            "Em là ánh nắng làm trái tim anh ấm áp mỗi ngày",
            "Bên em, mỗi khoảnh khắc đều trở nên đẹp đẽ và ý nghĩa",
            "Anh yêu em không chỉ vì em là ai, mà vì anh là ai khi ở bên em",
            "Em là điều tuyệt vời nhất đã đến với cuộc đời anh",
            "Mỗi ngày bên em là một món quà mà anh luôn trân trọng",
            "Anh muốn cùng em đi qua mọi nẻo đường của cuộc sống",
            "Em là lý do khiến mỗi ngày của anh tràn đầy niềm vui",
            "Tình yêu của anh dành cho em như những ngọn núi Hà Giang - vững chãi và bền bỉ",
            "Em là ngôi sao sáng nhất trên bầu trời đêm của anh",
            "Anh cảm ơn em vì đã đến và làm cuộc sống anh trở nên đẹp đẽ",
            "Mỗi khoảnh khắc bên em đều là những kỷ niệm đáng nhớ",
            "Anh yêu em từ những điều nhỏ nhặt nhất đến những điều lớn lao nhất",
            "Em là nguồn cảm hứng khiến anh muốn trở thành người tốt hơn mỗi ngày",
            "Bên em, anh cảm thấy như đang ở nhà",
            "Anh muốn cùng em viết nên câu chuyện tình yêu đẹp nhất",
            "Em là món quà quý giá nhất mà cuộc sống đã ban tặng cho anh",
            "Mỗi khi nhìn em, trái tim anh lại rung động như lần đầu gặp gỡ",
            "Anh yêu em không chỉ bằng trái tim mà còn bằng cả tâm hồn",
            "Em là người khiến anh tin vào tình yêu đích thực",
            "Cùng em, mọi thứ đều trở nên có ý nghĩa và đáng trân trọng",
        ];
        
        if (File::exists($imagesPath)) {
            $files = File::files($imagesPath);
            
            foreach ($files as $index => $file) {
                $extension = strtolower($file->getExtension());
                // Chỉ hiển thị các định dạng được trình duyệt hỗ trợ
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $images[] = [
                        'name' => $file->getFilename(),
                        'path' => asset('thuhong/' . $file->getFilename()),
                        'size' => $file->getSize(),
                        'message' => $loveMessages[$index % count($loveMessages)] ?? $loveMessages[0],
                    ];
                }
            }
        }
        
        return view('gallery.index', compact('images'));
    }
}

