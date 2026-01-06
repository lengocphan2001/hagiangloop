<?php

namespace Database\Seeders;

use App\Models\Tour;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tour 4N3Đ
        $tour4N3D = Tour::firstOrCreate(
            ['slug' => 'tour-4n3d'],
            [
            'name' => 'Tour 4N3Đ',
            'slug' => 'tour-4n3d',
            'duration' => '4N3Đ',
            'nights' => 3,
            'days' => 4,
            'is_active' => true,
            'sort_order' => 1,
            ]
        );

        // Delete existing days if updating
        if ($tour4N3D->wasRecentlyCreated === false) {
            $tour4N3D->days()->delete();
        }

        // Day 1
        $day1 = $tour4N3D->days()->create([
            'day_number' => 1,
            'title' => 'Ngày 1',
            'route' => 'Ha Giang-Quản Bạ-Yên Minh',
            'breakfast_time' => '08:00',
            'departure_time' => '10:30',
            'notes' => 'ăn sáng tại Alley Homestay và soạn đồ đạc bắt đầu cuộc hành trình',
            'sort_order' => 1,
        ]);

        $day1->locations()->createMany([
            ['name' => 'Đèo Bắc Sum', 'type' => 'location', 'sort_order' => 1],
            ['name' => 'Cổng trời', 'type' => 'location', 'sort_order' => 2],
            ['name' => 'Núi đôi', 'type' => 'location', 'sort_order' => 3],
            ['name' => 'Làng H\'mong', 'type' => 'location', 'sort_order' => 4],
            ['name' => 'Cây cô đơn', 'type' => 'location', 'sort_order' => 5],
            ['name' => 'Nhà ở Yên Minh', 'type' => 'accommodation', 'description' => 'ăn tối và nghỉ ngơi qua đêm', 'sort_order' => 6],
        ]);

        // Day 2
        $day2 = $tour4N3D->days()->create([
            'day_number' => 2,
            'title' => 'Ngày 2',
            'route' => 'Yên Minh-Đồng Văn',
            'breakfast_time' => '08:00',
            'departure_time' => '09:00',
            'notes' => 'ăn sáng',
            'sort_order' => 2,
        ]);

        $day2->locations()->createMany([
            ['name' => 'Dốc Thẩm Mã', 'type' => 'location', 'sort_order' => 1],
            ['name' => 'Làng Lũng Cẩm', 'type' => 'location', 'sort_order' => 2],
            ['name' => 'Nhà Vương', 'type' => 'location', 'sort_order' => 3],
            ['name' => 'Cột cờ Lũng Cú', 'type' => 'location', 'sort_order' => 4],
            ['name' => 'Làng Lô Lô Chải', 'type' => 'location', 'sort_order' => 5],
            ['name' => 'Phố cổ Đồng Văn', 'type' => 'accommodation', 'description' => 'ăn tối và nghỉ ngơi qua đêm', 'sort_order' => 6],
        ]);

        // Day 3
        $day3 = $tour4N3D->days()->create([
            'day_number' => 3,
            'title' => 'Ngày 3',
            'route' => 'Mèo Vạc-Yên Minh',
            'breakfast_time' => '08:00',
            'departure_time' => '09:00',
            'notes' => 'ăn sáng',
            'sort_order' => 3,
        ]);

        $day3->locations()->createMany([
            ['name' => 'Đèo Mã Lì Lèng', 'type' => 'location', 'sort_order' => 1],
            ['name' => 'Hẻm Tu Sản ở sông Nho Quế', 'type' => 'location', 'sort_order' => 2],
            ['name' => 'Mỏm đá tử thần', 'type' => 'location', 'sort_order' => 3],
            ['name' => 'Cua chữ M', 'type' => 'location', 'sort_order' => 4],
            ['name' => 'Mậu Duệ', 'type' => 'meal', 'description' => 'ăn trưa', 'sort_order' => 5],
            ['name' => 'Du Già', 'type' => 'accommodation', 'description' => 'ăn tối và nghỉ ngơi', 'sort_order' => 6],
        ]);

        // Day 4
        $day4 = $tour4N3D->days()->create([
            'day_number' => 4,
            'title' => 'Ngày 4',
            'route' => 'Yên Minh-Quản Bạ-Ha Giang',
            'breakfast_time' => '08:00',
            'departure_time' => '09:00',
            'notes' => 'ăn sáng',
            'sort_order' => 4,
        ]);

        $day4->locations()->createMany([
            ['name' => 'Thác Du Già', 'type' => 'location', 'sort_order' => 1],
            ['name' => 'Làng dệt Lũng Tám', 'type' => 'location', 'sort_order' => 2],
            ['name' => 'Alley Homestay', 'type' => 'location', 'sort_order' => 3],
        ]);

        // Tour 3N2Đ
        $tour3N2D = Tour::firstOrCreate(
            ['slug' => 'tour-3n2d'],
            [
            'name' => 'Tour 3N2Đ',
            'slug' => 'tour-3n2d',
            'duration' => '3N2Đ',
            'nights' => 2,
            'days' => 3,
            'is_active' => true,
            'sort_order' => 2,
            ]
        );

        // Delete existing days if updating
        if ($tour3N2D->wasRecentlyCreated === false) {
            $tour3N2D->days()->delete();
        }

        // Day 1
        $day1_3N2D = $tour3N2D->days()->create([
            'day_number' => 1,
            'title' => 'Ngày 1',
            'route' => 'Ha Giang-Quản Bạ-Yên Minh',
            'breakfast_time' => '08:00',
            'departure_time' => '10:30',
            'notes' => 'ăn sáng tại Alley Homestay và soạn đồ đạc bắt đầu cuộc hành trình',
            'sort_order' => 1,
        ]);

        $day1_3N2D->locations()->createMany([
            ['name' => 'Đèo Bắc Sum', 'type' => 'location', 'sort_order' => 1],
            ['name' => 'Cổng trời', 'type' => 'location', 'sort_order' => 2],
            ['name' => 'Núi đôi', 'type' => 'location', 'sort_order' => 3],
            ['name' => 'Làng H\'mong', 'type' => 'location', 'sort_order' => 4],
            ['name' => 'Rừng thông', 'type' => 'location', 'sort_order' => 5],
            ['name' => 'Nhà ở Yên Minh', 'type' => 'accommodation', 'description' => 'ăn tối và nghỉ ngơi qua đêm', 'sort_order' => 6],
        ]);

        // Day 2
        $day2_3N2D = $tour3N2D->days()->create([
            'day_number' => 2,
            'title' => 'Ngày 2',
            'route' => 'Yên Minh-Đồng Văn',
            'breakfast_time' => '08:00',
            'departure_time' => '09:00',
            'notes' => 'ăn sáng',
            'sort_order' => 2,
        ]);

        $day2_3N2D->locations()->createMany([
            ['name' => 'Dốc Thẩm Mã', 'type' => 'location', 'sort_order' => 1],
            ['name' => 'Làng Lũng Cẩm', 'type' => 'location', 'sort_order' => 2],
            ['name' => 'Cột cờ Lũng Cú', 'type' => 'location', 'sort_order' => 3],
            ['name' => 'Làng Lô Lô Chải', 'type' => 'location', 'sort_order' => 4],
            ['name' => 'Phố cổ Đồng Văn', 'type' => 'accommodation', 'description' => 'ăn tối và nghỉ ngơi qua đêm', 'sort_order' => 5],
        ]);

        // Day 3
        $day3_3N2D = $tour3N2D->days()->create([
            'day_number' => 3,
            'title' => 'Ngày 3',
            'route' => 'Mèo Vạc-Yên Minh-Ha Giang',
            'breakfast_time' => '08:00',
            'departure_time' => '09:00',
            'notes' => 'ăn sáng',
            'sort_order' => 3,
        ]);

        $day3_3N2D->locations()->createMany([
            ['name' => 'Đèo Mã Lì Lèng', 'type' => 'location', 'sort_order' => 1],
            ['name' => 'Mỏm đá tử thần', 'type' => 'location', 'sort_order' => 2],
            ['name' => 'Cua chữ M', 'type' => 'location', 'sort_order' => 3],
            ['name' => 'Mậu Duệ', 'type' => 'meal', 'description' => 'ăn trưa', 'sort_order' => 4],
            ['name' => 'Alley homestay', 'type' => 'location', 'sort_order' => 5],
        ]);

        // Tour 2N1Đ
        $tour2N1D = Tour::firstOrCreate(
            ['slug' => 'tour-2n1d'],
            [
            'name' => 'Tour 2N1Đ',
            'slug' => 'tour-2n1d',
            'duration' => '2N1Đ',
            'nights' => 1,
            'days' => 2,
            'is_active' => true,
            'sort_order' => 3,
            ]
        );

        // Delete existing days if updating
        if ($tour2N1D->wasRecentlyCreated === false) {
            $tour2N1D->days()->delete();
        }

        // Day 1
        $day1_2N1D = $tour2N1D->days()->create([
            'day_number' => 1,
            'title' => 'Ngày 1',
            'route' => 'Ha Giang-Quản Bạ-Yên Minh-Đồng Văn',
            'breakfast_time' => '08:00',
            'departure_time' => '10:30',
            'notes' => 'ăn sáng tại Alley Homestay và soạn đồ đạc bắt đầu cuộc hành trình',
            'sort_order' => 1,
        ]);

        $day1_2N1D->locations()->createMany([
            ['name' => 'Đèo Bắc Sum', 'type' => 'location', 'sort_order' => 1],
            ['name' => 'Cổng trời', 'type' => 'location', 'sort_order' => 2],
            ['name' => 'Núi đôi', 'type' => 'location', 'sort_order' => 3],
            ['name' => 'Rừng thông', 'type' => 'location', 'sort_order' => 4],
            ['name' => 'Dốc Thẩm Mã', 'type' => 'location', 'sort_order' => 5],
            ['name' => 'Phố cổ Đồng Văn', 'type' => 'accommodation', 'description' => 'ăn tối và nghỉ ngơi qua đêm', 'sort_order' => 6],
        ]);

        // Day 2
        $day2_2N1D = $tour2N1D->days()->create([
            'day_number' => 2,
            'title' => 'Ngày 2',
            'route' => 'Đồng Văn-Mèo Vạc-Yên Minh-Ha Giang',
            'breakfast_time' => '08:00',
            'departure_time' => '09:00',
            'notes' => 'ăn sáng',
            'sort_order' => 2,
        ]);

        $day2_2N1D->locations()->createMany([
            ['name' => 'Mỏm đá tử thần', 'type' => 'location', 'sort_order' => 1],
            ['name' => 'Cua chữ M', 'type' => 'location', 'sort_order' => 2],
            ['name' => 'Mậu Duệ', 'type' => 'location', 'sort_order' => 3],
            ['name' => 'Alley homestay', 'type' => 'location', 'sort_order' => 4],
        ]);

        $this->command->info('Tours seeded successfully!');
    }
}
