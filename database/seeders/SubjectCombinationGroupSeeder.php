<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SubjectCombinationGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('subject_combination_groups')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        \DB::table('subject_combination_groups')->insert([
            [
                'name' => 'Khối A',
                'description' => 'Đây là khối tự nhiên, có rất nhiều ngành nghề thuộc khối A học sinh có thể lựa chọn theo học như: Kinh tế, Quản trị kinh doanh, Luật, Công nghệ thông tin…Dưới đây là thông tin chi tiết các tổ hộp môn tự nhiên (môn thuộc khối A):',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Khối B',
                'description' => 'Đây là khối tập trung chủ yếu vào các ngành Khoa học, Y dược, Thủy sản, Nông – Lâm – Ngư nghiệp…Dưới đây là chi tiết các tổ hợp môn thuộc khối B:',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Khối C',
                'description' => 'Là khối về khoa học xã hội, văn học, báo chí, nhân văn, phát luật…Dưới đây là tổng hợp các tổ hợp môn xã hội (thuộc khối C) học sinh có thể tham khảo:',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Khối D',
                'description' => 'Các ngành thuộc ngoại ngữ, kinh tế, tài chính, công nghệ thông tin, quan trị kinh doanh…trong những năm gần đây được nhiều trường lựa chọn để xét tuyển sinh viên thi khối D. Tổ hợp khối D được xét tuyển đại học, cao đẳng gồm',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Khối H',
                'description' => 'Đây là khối ngành năng khiếu dành cho những học sinh đam mê vẽ, có khả năng hội họa. Tổng hợp các tổ hợp môn xét tuyển gồm',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Khối K',
                'description' => 'Đây là khối dành cho những thí sinh tốt nghiệp trung cấp chuyên nghiệp hoặc tốt nghiệp cao đẳng có nhu cầu liên thông lên đại học. Các môn thi của khối K là Toán, Lý và một môn thi chuyên ngành đã học ở trung cấp, cao đẳng',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Khối M',
                'description' => 'Khối chuyên tuyển sinh các ngành như giáo viên thanh nhạc, điện ảnh truyền hình, giáo viên mầm non…Sau đâu là tổ hợp môn xét tuyển đại học, cao đẳng thuộc khối M',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Khối N',
                'description' => 'Khối N tập trung vào khả năng âm nhạc, các học sinh dự thi vào khối này có cần có năng khiếu âm nhạc, khả năng thanh nhạc hoặc một vài năng khiếu khác. Dưới đây là tổ hợp xét tuyển các môn thuộc khối N',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Khối R',
                'description' => 'Là khối xét tuyển vào các chuyên ngành như: Nghệ thuật, báo chí…Chi tiết các tổ hợp môn thuộc 2 khối này chi tiết như sau:',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Khối S',
                'description' => 'Là khối xét tuyển vào các chuyên ngành như: Nghệ thuật, báo chí…Chi tiết các tổ hợp môn thuộc 2 khối này chi tiết như sau:',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Khối T',
                'description' => 'Những thí sinh có năng khiếu thể dục, thể thao có thể đăng ký xét tuyển vào khối này. Tổ hợp môn của khối T lần lượt như sau',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Khối V',
                'description' => 'Khối chủ yếu xét tuyển vào các trường mĩ thuật như kiến trúc, sau đây là tổ hợp môn thuộc khối V',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
