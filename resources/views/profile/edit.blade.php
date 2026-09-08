<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="h-10 w-10 rounded-lg flex items-center justify-center text-white" style="background:linear-gradient(135deg,#0E5393 0%,#04192D 100%);">
                <i class="fas fa-user-edit text-lg"></i>
            </div>
            <div>
                <h2 class="font-black text-xl text-gray-800 leading-tight uppercase tracking-tight">Profile Settings</h2>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Barangay San Miguel II</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 space-y-6">

            {{-- Profile Information --}}
            <div style="background:#fff;border-radius:16px;box-shadow:0 4px 24px rgba(4,25,45,.10);border:1px solid #e2e8f0;overflow:hidden;">
                <div style="background:linear-gradient(135deg,#000052 0%,#0E5393 100%);padding:16px 22px;">
                    <div style="font-size:12px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.06em;">
                        <i class="fas fa-user" style="margin-right:7px;"></i> Profile Information
                    </div>
                    <div style="font-size:10px;color:rgba(255,255,255,.6);margin-top:2px;font-weight:600;">Update your account name and email address.</div>
                </div>
                <div class="p-6">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Change Password (staff security question route) --}}
            <div style="background:#fff;border-radius:16px;box-shadow:0 4px 24px rgba(4,25,45,.10);border:1px solid #e2e8f0;overflow:hidden;">
                <div style="background:linear-gradient(135deg,#04192D 0%,#0E5393 100%);padding:16px 22px;">
                    <div style="font-size:12px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.06em;">
                        <i class="fas fa-key" style="margin-right:7px;"></i> Change Password
                    </div>
                    <div style="font-size:10px;color:rgba(255,255,255,.6);margin-top:2px;font-weight:600;">Security verification required to change your password.</div>
                </div>
                <div class="p-6">
                    <p style="font-size:11px;color:#64748b;font-weight:600;margin-bottom:14px;line-height:1.6;">
                        To protect barangay system security, changing your password requires answering a security question that only authorized barangay officials know. This ensures only verified staff can update their credentials.
                    </p>
                    <a href="{{ route('staff.password.show') }}"
                       style="display:inline-flex;align-items:center;gap:7px;padding:10px 18px;background:linear-gradient(135deg,#0E5393 0%,#04192D 100%);color:#fff;font-family:inherit;font-size:11px;font-weight:900;letter-spacing:.05em;text-transform:uppercase;border:none;border-radius:10px;cursor:pointer;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,82,.28);">
                        <i class="fas fa-key"></i> Change My Password
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
