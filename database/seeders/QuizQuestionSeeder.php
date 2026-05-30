<?php

namespace Database\Seeders;

use App\Models\QuizQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizQuestionSeeder extends Seeder
{
    public function run(): void
    {
        QuizQuestion::query()->delete();

        QuizQuestion::create([
            'question' => 'Bạn đang làm cảnh sát chìm (Undercover) và tình cờ thấy một người chơi khác đang cướp cửa hàng tiện lợi 24/7. Ở ngoài đời (OOC), bạn không hề biết trước về vụ cướp này. Bạn nên xử lý thế nào trong game (IC)?',
            'answer_1' => 'Bơ đi, mình đâu có được giao nhiệm vụ đi tuần khu này.',
            'answer_2' => 'Gọi cứu viện (Backup) qua bộ đàm và can thiệp, khống chế tên cướp.',
            'answer_3' => 'Núp một chỗ đợi nó cướp xong rời đi rồi mới vào khám nghiệm hiện trường.',
            'answer_4' => 'PM (/b hoặc nhắn tin riêng) hỏi nó sao lại đi cướp.',
            'correct_answer' => 2,
        ]);

        QuizQuestion::create([
            'question' => 'Bạn đang bị cảnh sát (LSPD) rượt đuổi gắt gao. Xe của bạn đang bốc khói đen và sắp nổ. Bạn định tông thẳng vào xe của một người chơi khác đang đi trên đường để xe mình dừng lại. Điều này có được phép không?',
            'answer_1' => 'Có, đó là cách duy nhất để cứu mạng mình lúc đó.',
            'answer_2' => 'Không, bạn không được phép ép người khác vào tình huống Roleplay của mình một cách vô lý (Lỗi Car Ramming / Non-RP).',
            'answer_3' => 'Chỉ được tông nếu người đó cũng đang bị cảnh sát rượt đuổi.',
            'answer_4' => 'Được, nhưng bạn phải đền tiền sửa xe cho họ sau khi hết tình huống.',
            'correct_answer' => 2,
        ]);

        QuizQuestion::create([
            'question' => 'Bạn đang đi dạo trong rừng (khu vực vắng người) và vô tình phát hiện một rương chứa đầy vũ khí lậu. Bạn sẽ làm gì?',
            'answer_1' => 'Chat lên kênh thế giới (/pr, /o) khoe đồ và rao bán xem ai mua không.',
            'answer_2' => 'Gom hết cất đi để sau này có vũ khí đi war (bắn nhau) với gang khác.',
            'answer_3' => 'Báo cảnh sát và Roleplay quá trình bạn vô tình phát hiện ra số vũ khí đó.',
            'answer_4' => 'Mang lên group Facebook của server rao bán lấy tiền thật (VND).',
            'correct_answer' => 3,
        ]);

        QuizQuestion::create([
            'question' => 'Bạn là nhân viên cấp cứu (Faction FDSA) và đến hiện trường có người bị thương nặng. Một người chơi khác không phải bác sĩ lại cứ cố dùng băng gạc (bandage) để cứu người đó. Bạn nên làm gì?',
            'answer_1' => 'Mặc kệ họ, tự mình cứu bệnh nhân thôi.',
            'answer_2' => 'Chửi mắng họ bầm dập vì dám cản trở người thi hành công vụ.',
            'answer_3' => 'Từ tốn giải thích (IC) rằng chỉ có nhân viên y tế mới có đủ chuyên môn xử lý vết thương nặng và yêu cầu họ lùi lại.',
            'answer_4' => 'Cứ để họ cứu thử, biết đâu game lag lại cứu được.',
            'correct_answer' => 3,
        ]);

        QuizQuestion::create([
            'question' => 'Bạn vừa phạm tội và bị cảnh sát còng tay (Tazer/Cuff) bắt giữ. Bạn nên làm gì tiếp theo?',
            'answer_1' => 'Cãi tay đôi với cảnh sát và tìm mọi bug game để tẩu thoát.',
            'answer_2' => 'Hợp tác Roleplay tình huống bị bắt giữ và lấy lời khai một cách hợp lý.',
            'answer_3' => 'Bấm /q (Thoát game) liền để trốn tù (Lỗi LTA - Logging to Avoid).',
            'answer_4' => 'Đe dọa (OOC) sẽ kiện cảnh sát lên diễn đàn vì tội lạm quyền.',
            'correct_answer' => 2,
        ]);

        QuizQuestion::create([
            'question' => 'Bạn cảm thấy rất bực mình và ức chế với cách Roleplay của một người chơi khác (ví dụ: họ cố tình phá game, Non-RP). Cách giải quyết tốt nhất là gì?',
            'answer_1' => 'Chửi rủa, lăng mạ người ta liên tục trên kênh chat thế giới (Toxic).',
            'answer_2' => 'F8 chụp ảnh hoặc quay video lại làm bằng chứng, sau đó kiện lên Diễn đàn/Discord cho Admin giải quyết.',
            'answer_3' => 'Ghi thù và rủ faction/gang của mình đi KOS (Kill on Sight) cắn trộm nó trả thù.',
            'answer_4' => 'Bỏ qua và hy vọng lần sau không xui xẻo gặp lại nó nữa.',
            'correct_answer' => 2,
        ]);

        QuizQuestion::create([
            'question' => 'Bạn đang on-duty cảnh sát và tận mắt thấy một người chơi khác đang bẻ khóa xe trộm cắp. Bạn nên làm gì?',
            'answer_1' => 'Mặc kệ, chừng nào có người report thì mới đến xử lý.',
            'answer_2' => 'Tiếp cận, Roleplay điều tra hành vi phạm tội và tiến hành bắt giữ theo luật thành phố.',
            'answer_3' => 'PM (/b) khuyên người chơi đó đừng phá luật nữa.',
            'answer_4' => '/report gọi Admin vào ban người đó ngay lập tức mà không cần Roleplay.',
            'correct_answer' => 2,
        ]);

        QuizQuestion::create([
            'question' => 'Bạn đang làm chủ một cửa hàng (Biz). Có một người chơi đến đòi mua một lượng lớn hàng hóa nhưng lại ép giá cực kỳ phi lý (quá rẻ mạt so với kinh tế server). Bạn nên làm gì?',
            'answer_1' => 'Bán luôn, game mà, có tiền là được.',
            'answer_2' => 'Roleplay hỏi họ (IC) tại sao lại cần mua số lượng lớn như vậy và thương lượng lại giá cả cho thực tế.',
            'answer_3' => 'Đứng im không thèm trả lời (Non-RP hành vi).',
            'answer_4' => 'Cứ bán, nhưng sau đó ra Discord report tội lừa đảo.',
            'correct_answer' => 2,
        ]);

        QuizQuestion::create([
            'question' => 'Khi xây dựng tiểu sử (Backstory) cho nhân vật của mình trên máy chủ, bạn KHÔNG nên đưa vào yếu tố nào dưới đây?',
            'answer_1' => 'Từng có quá khứ phục vụ trong quân đội trước khi đến thành phố.',
            'answer_2' => 'Biết rõ tên tuổi, địa bàn của tất cả các trùm giang hồ trong thành phố dù chưa từng gặp mặt (Lỗi Metagaming).',
            'answer_3' => 'Một sự kiện bi thảm trong quá khứ làm động lực sống cho nhân vật hiện tại.',
            'answer_4' => 'Chi tiết về các thành viên trong gia đình hoặc nguồn gốc xuất thân của nhân vật.',
            'correct_answer' => 2,
        ]);
    }
}
