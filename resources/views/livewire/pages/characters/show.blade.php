<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;

new
#[Title('Chi tiết nhân vật')]
#[Layout('layouts.app')]
class extends Component {

    public $character;
    public $jobTypes = [];

    public function mount($id)
    {
        $this->character = \App\Models\User::findOrFail($id);
        if ($this->character->id !== auth()->id() && auth()->user()->AdminLevel < 4) {
            abort(403);
        }
        $this->jobTypes = \App\Models\JobType::pluck('name', 'id')->toArray();
    }

    public function getJobName($jobId)
    {
        if ($jobId == 0) return null;
        return $this->jobTypes[$jobId] ?? "Job #$jobId";
    }

}; ?>

<div class="p-6 space-y-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('characters') }}" class="h-10 w-10 rounded-full bg-[#2D2F34] p-2 text-gray-500 hover:text-gray-400 transition">
            <x-heroicon-c-arrow-left-circle class="w-6 h-6" />
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-200">{{ str_replace('_', ' ', $character->Username) }}</h1>
            <p class="text-gray-400 text-sm">ID: {{ $character->id }} &bull; Level {{ $character->Level }}</p>
        </div>
    </div>

    {{-- Basic Info --}}
    <div class="bg-gray-900 rounded-lg border border-stroke-primary p-6">
        <h2 class="text-lg font-semibold text-gray-200 mb-4">Thông tin cơ bản</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div>
                <p class="text-gray-400 text-sm">Giới tính</p>
                <p class="text-gray-200 font-medium">{{ $character->Sex == 1 ? 'Nam' : 'Nữ' }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Skin ID</p>
                <p class="text-gray-200 font-medium">{{ $character->Model }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Cấp độ</p>
                <p class="text-gray-200 font-medium">{{ $character->Level }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Respect</p>
                <p class="text-gray-200 font-medium">{{ number_format($character->Respect) }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Giờ chơi</p>
                <p class="text-gray-200 font-medium">{{ number_format($character->Hours) }} giờ</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Lần đăng nhập cuối</p>
                <p class="text-gray-200 font-medium">{{ $character->LastLogin ?? 'Chưa có' }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Ngày đăng ký</p>
                <p class="text-gray-200 font-medium">{{ $character->RegiDate ?? 'Chưa có' }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Quốc tịch</p>
                <p class="text-gray-200 font-medium">{{ $character->Nation == 1 ? 'Los Santos' : ($character->Nation == 2 ? 'San Fierro' : 'Chưa chọn') }}</p>
            </div>
        </div>
    </div>

    {{-- Financial --}}
    <div class="bg-gray-900 rounded-lg border border-stroke-primary p-6">
        <h2 class="text-lg font-semibold text-gray-200 mb-4">Tài chính</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-gray-800 rounded-lg p-4">
                <p class="text-gray-400 text-sm">Tiền mặt</p>
                <p class="text-green-400 text-xl font-bold">${{ number_format($character->Money) }}</p>
            </div>
            <div class="bg-gray-800 rounded-lg p-4">
                <p class="text-gray-400 text-sm">Ngân hàng</p>
                <p class="text-blue-400 text-xl font-bold">${{ number_format($character->Bank) }}</p>
            </div>
            <div class="bg-gray-800 rounded-lg p-4">
                <p class="text-gray-400 text-sm">Paycheck</p>
                <p class="text-yellow-400 text-xl font-bold">${{ number_format($character->Paycheck) }}</p>
            </div>
            <div class="bg-gray-800 rounded-lg p-4">
                <p class="text-gray-400 text-sm">Credits</p>
                <p class="text-purple-400 text-xl font-bold">{{ number_format($character->Credits) }}</p>
            </div>
        </div>
    </div>

    {{-- Faction --}}
    <div class="bg-gray-900 rounded-lg border border-stroke-primary p-6">
        <h2 class="text-lg font-semibold text-gray-200 mb-4">Tổ chức</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div>
                <p class="text-gray-400 text-sm">Faction</p>
                <p class="text-gray-200 font-medium">{{ $character->faction ? $character->faction->Name : 'Không có' }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Chức vụ</p>
                <p class="text-gray-200 font-medium">{{ $character->Rank == 255 ? 'Không có' : 'Rank ' . $character->Rank }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Division</p>
                <p class="text-gray-200 font-medium">{{ $character->Division == -1 ? 'Không có' : $character->Division }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Leader</p>
                <p class="text-gray-200 font-medium">{{ $character->Leader == -1 ? 'Không' : 'Có' }}</p>
            </div>
        </div>
    </div>

    {{-- Jobs --}}
    <div class="bg-gray-900 rounded-lg border border-stroke-primary p-6">
        <h2 class="text-lg font-semibold text-gray-200 mb-4">Nghề nghiệp</h2>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <p class="text-gray-400 text-sm">Nghề 1</p>
                <p class="text-gray-200 font-medium">{{ $character->Job == 0 ? 'Thất nghiệp' : ($this->jobTypes[$character->Job] ?? 'Job #' . $character->Job) }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Nghề 2</p>
                <p class="text-gray-200 font-medium">{{ $character->Job2 == 0 ? 'Không có' : ($this->jobTypes[$character->Job2] ?? 'Job #' . $character->Job2) }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Nghề 3</p>
                <p class="text-gray-200 font-medium">{{ $character->Job3 == 0 ? 'Không có' : ($this->jobTypes[$character->Job3] ?? 'Job #' . $character->Job3) }}</p>
            </div>
        </div>
    </div>

    {{-- Skills --}}
    <div class="bg-gray-900 rounded-lg border border-stroke-primary p-6">
        <h2 class="text-lg font-semibold text-gray-200 mb-4">Kỹ năng</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach(['Detective' => 'DetSkill', 'Sex' => 'SexSkill', 'Boxing' => 'BoxSkill', 'Law' => 'LawSkill', 'Mechanic' => 'MechSkill', 'Trucker' => 'TruckSkill', 'Arms' => 'ArmsSkill', 'Fishing' => 'FishSkill'] as $name => $field)
                <div>
                    <p class="text-gray-400 text-sm">{{ $name }}</p>
                    <div class="flex items-center space-x-2">
                        <div class="flex-1 bg-gray-800 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: {{ min(100, $character->$field / 4) }}%"></div>
                        </div>
                        <span class="text-gray-200 text-sm">{{ $character->$field }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Licenses --}}
    <div class="bg-gray-900 rounded-lg border border-stroke-primary p-6">
        <h2 class="text-lg font-semibold text-gray-200 mb-4">Giấy phép</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @foreach(['Bằng lái xe' => 'CarLic', 'Bằng lái bay' => 'FlyLic', 'Bằng lái thuyền' => 'BoatLic', 'Bằng câu cá' => 'FishLic', 'Giấy phép súng' => 'GunLic'] as $name => $field)
                <div class="flex items-center space-x-2">
                    @if($character->$field)
                        <x-heroicon-m-check-circle class="w-5 h-5 text-green-400" />
                    @else
                        <x-heroicon-m-x-circle class="w-5 h-5 text-red-400" />
                    @endif
                    <span class="text-gray-200 text-sm">{{ $name }}</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Weapons --}}
    <div class="bg-gray-900 rounded-lg border border-stroke-primary p-6">
        <h2 class="text-lg font-semibold text-gray-200 mb-4">Súng trên người</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @for($i = 0; $i <= 11; $i++)
                @php $gun = $character->{"Gun$i"}; @endphp
                @if($gun > 0)
                    <div class="bg-gray-800 rounded-lg p-3">
                        <p class="text-gray-400 text-sm">Slot {{ $i }}</p>
                        <p class="text-gray-200 font-medium">Weapon ID: {{ $gun }}</p>
                    </div>
                @endif
            @endfor
            @if(collect(range(0,11))->every(fn($i) => $character->{"Gun$i"} == 0))
                <p class="text-gray-500 col-span-4">Không có súng</p>
            @endif
        </div>
    </div>

    {{-- Health & Status --}}
    <div class="bg-gray-900 rounded-lg border border-stroke-primary p-6">
        <h2 class="text-lg font-semibold text-gray-200 mb-4">Trạng thái</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div>
                <p class="text-gray-400 text-sm">Máu</p>
                <p class="text-red-400 font-medium">{{ number_format($character->pHealth, 1) }} HP</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Giáp</p>
                <p class="text-blue-400 font-medium">{{ number_format($character->pArmor, 1) }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Wanted Level</p>
                <p class="text-yellow-400 font-medium">{{ $character->WantedLevel }} sao</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Jail Time</p>
                <p class="text-red-400 font-medium">{{ $character->JailTime > 0 ? $character->JailTime . ' giây' : 'Không' }}</p>
            </div>
        </div>
        @if($character->JailTime > 0)
            <div class="mt-4 bg-red-900/30 border border-red-800 rounded-lg p-3">
                <p class="text-red-400 text-sm"><strong>Lý do:</strong> {{ $character->PrisonReason }}</p>
                <p class="text-red-400 text-sm"><strong>Quản trị viên:</strong> {{ $character->PrisonedBy }}</p>
            </div>
        @endif
    </div>
</div>
