<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;

new
#[Title('Hỗ trợ')]
#[Layout('layouts.app')]
class extends Component {

}; ?>

<div class="p-6 space-y-6">
    <h1 class="text-2xl font-bold text-gray-200">Hỗ trợ</h1>

    <div class="bg-gray-900 rounded-lg border border-stroke-primary p-6">
        <h2 class="text-lg font-semibold text-gray-200 mb-4 flex items-center space-x-2">
            <x-heroicon-s-book-open class="w-5 h-5 text-blue-400" />
            <span>Hướng dẫn bắt đầu</span>
        </h2>
        <div class="space-y-4 text-sm text-gray-300">
            <div>
                <h3 class="font-semibold text-gray-200 mb-1">Bước 1: Đăng ký tài khoản</h3>
                <p class="text-gray-400">Truy cập trang đăng ký, nhập tên nhân vật (định dạng Họ_Tên), email và mật khẩu.</p>
            </div>
            <div>
                <h3 class="font-semibold text-gray-200 mb-1">Bước 2: Tải SA-MP</h3>
                <p class="text-gray-400">Tải SA-MP tại <a href="https://www.sa-mp.mp/downloads/" class="text-blue-400 hover:underline" target="_blank">www.sa-mp.mp/downloads</a> và cài đặt.</p>
            </div>
            <div>
                <h3 class="font-semibold text-gray-200 mb-1">Bước 3: Kết nối vào server</h3>
                <p class="text-gray-400">Mở SA-MP → Add Server → nhập địa chỉ server → Connect. Đăng nhập bằng tài khoản đã tạo.</p>
            </div>
            <div>
                <h3 class="font-semibold text-gray-200 mb-1">Bước 4: Tạo nhân vật</h3>
                <p class="text-gray-400">Lần đầu vào game, hệ thống sẽ hướng dẫn bạn chọn giới tính, ngoại hình và hoàn thành tutorial.</p>
            </div>
        </div>
    </div>

    <div class="bg-gray-900 rounded-lg border border-stroke-primary p-6">
        <h2 class="text-lg font-semibold text-gray-200 mb-4 flex items-center space-x-2">
            <x-heroicon-s-question-mark-circle class="w-5 h-5 text-yellow-400" />
            <span>Câu hỏi thường gặp</span>
        </h2>
        <div class="space-y-4" x-data="{ openFaq: null }">
            @php
            $faqs = [
                ['q' => 'Tôi không thể đăng nhập trong game?', 'a' => 'Đảm bảo bạn đã đăng ký trên UCP này trước. Tên đăng nhập trong game phải trùng với tên tài khoản trên UCP.'],
                ['q' => 'Tôi quên mật khẩu?', 'a' => 'Sử dụng tính năng "Quên mật khẩu" tại trang đăng nhập để đặt lại mật khẩu qua email.'],
                ['q' => 'SA-MP là gì? Tôi cần tải ở đâu?', 'a' => 'SA-MP (San Andreas Multiplayer) là mod chơi multiplayer cho GTA San Andreas. Tải tại www.sa-mp.mp/downloads'],
                ['q' => 'Tôi cần cài GTA San Andreas trước không?', 'a' => 'Có, bạn cần có GTA San Andreas đã cài đặt trên máy tính trước khi cài SA-MP.'],
                ['q' => 'Tên nhân vật có quy tắc gì?', 'a' => 'Tên phải theo định dạng Họ_Tên (ví dụ: Nguyen_Van_A). Không được dùng tên người nổi tiếng, từ ngữ không phù hợp.'],
            ];
            @endphp
            @foreach($faqs as $i => $faq)
            <div class="border border-gray-700 rounded-lg overflow-hidden">
                <button @click="openFaq === {{ $i }} ? openFaq = null : openFaq = {{ $i }}" class="w-full text-left p-4 flex items-center justify-between hover:bg-gray-800/50 transition">
                    <span class="text-sm font-medium text-gray-200">{{ $faq['q'] }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === {{ $i }} }">
                        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="openFaq === {{ $i }}" x-collapse class="px-4 pb-4">
                    <p class="text-sm text-gray-400">{{ $faq['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="bg-gray-900 rounded-lg border border-stroke-primary p-6">
        <h2 class="text-lg font-semibold text-gray-200 mb-4 flex items-center space-x-2">
            <x-heroicon-s-chat-bubble-left-right class="w-5 h-5 text-green-400" />
            <span>Liên hệ hỗ trợ</span>
        </h2>
        <p class="text-sm text-gray-400 mb-4">Không tìm thấy câu trả lời? Liên hệ đội ngũ nhân viên qua:</p>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ config('app.discord_url') }}" target="_blank" class="inline-flex items-center space-x-2 bg-[#404EED] hover:bg-[#3641C7] text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                <img src="{{ asset('assets/logos/discord.svg') }}" class="w-5 h-5" alt="Discord">
                <span>Discord</span>
            </a>
            <span class="inline-flex items-center space-x-2 bg-gray-800 text-gray-300 px-4 py-2 rounded-lg text-sm">
                <x-heroicon-m-chat-bubble-left-ellipsis class="w-5 h-5" />
                <span>In-game: /help hoặc /report</span>
            </span>
        </div>
    </div>
</div>
