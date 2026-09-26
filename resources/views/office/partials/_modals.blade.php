{{-- ✦ Ready for Pickup Modal ✦ --}}
<div x-show="showReadyModal" x-cloak class="modal-ov" style="z-index:999;" x-transition>
    <div class="modal-box" style="max-width:400px;" @click.away="showReadyModal=false">
        <div class="modal-in">
            <div class="modal-hd">
                <div class="modal-ttl">
                    <div class="modal-ttl-ico"><i class="fas fa-calendar-check"></i></div>
                    <div>Pickup Schedule</div>
                </div>
                <button @click="showReadyModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
            </div>
            <div style="margin-bottom:16px;">
                <div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedReq.name"></div>
                <div style="font-size:10px;color:var(--brand);font-weight:700;text-transform:uppercase;" x-text="selectedReq.type"></div>
            </div>
            <form :action="'/office/document-request/' + selectedReq.id + '/status'" method="POST">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="ready">
                
                <div class="fgrp">
                    <label class="flbl">Scheduled Pickup Date *</label>
                    <input type="date" name="pickup_date" x-model="selectedReq.date" required class="finput" :min="new Date().toISOString().split('T')[0]">
                </div>
                <div class="fgrid2">
                    <div class="fgrp">
                        <label class="flbl">Pickup Time *</label>
                        <input type="time" name="pickup_time" x-model="selectedReq.time" required class="finput">
                    </div>
                    <div class="fgrp">
                        <label class="flbl">Personnel in Charge *</label>
                        <input type="text" name="personnel_in_charge" required class="finput" placeholder="e.g. Secretary Name">
                    </div>
                    <div class="fspan2 fgrp" style="margin-top:-6px;">
                        <label class="flbl">Alternate Personnel (Optional)</label>
                        <input type="text" name="alternate_personnel" class="finput" placeholder="e.g. Any available staff (Barangay San Miguel II Hall, Dasmariñas City, Cavite)">
                    </div>
                </div>
                
                <div style="background:#eff6ff;padding:10px;border-radius:10px;border:1px solid #bfdbfe;margin-bottom:16px;">
                    <p style="font-size:9px;color:#1e40af;font-weight:700;line-height:1.4;">
                        <i class="fas fa-info-circle"></i> Ang residente ay makatatanggap ng email notification na handa na ang kanyang dokumento para sa pick-up. Awtomatiko rin siyang papadalhan ng paalala 30 minuto bago ang kanyang appointment.
                    </p>
                </div>

                <div style="display:flex;justify-content:flex-end;gap:10px;">
                    <button type="button" @click="showReadyModal=false" class="btn-plain btn-edit">Cancel</button>
                    <button type="submit" class="btn-grad"><i class="fas fa-paper-plane"></i> Approve & Notify</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ══ DOCUMENT MODALS ══ --}}
@php
$docConfigs = [
    ['key'=>'residency',    'title'=>'Certificate of Residency',         'icon'=>'fa-house-user',         'placeholder'=>'e.g. Loan, School requirement',       'body'=>'residency'],
    ['key'=>'indigency',    'title'=>'Certificate of Indigency',          'icon'=>'fa-file-signature',     'placeholder'=>'e.g. Medical assistance, PhilHealth', 'body'=>'indigency'],
    ['key'=>'clearance',    'title'=>'Barangay Clearance',                'icon'=>'fa-shield-alt',         'placeholder'=>'e.g. Employment, Police clearance',   'body'=>'clearance'],
    ['key'=>'jobseeker',    'title'=>'Certificate for Job Seeker',        'icon'=>'fa-user-tie',           'placeholder'=>'e.g. DOLE requirement',               'body'=>'jobseeker'],
    ['key'=>'business',     'title'=>'Business Clearance',                'icon'=>'fa-store',              'placeholder'=>'e.g. Business permit application',    'body'=>'business'],
    ['key'=>'endorsement',  'title'=>'Barangay Endorsement',              'icon'=>'fa-file-export',        'placeholder'=>'e.g. Endorsement to DSWD, Mayor',     'body'=>'endorsement'],
    ['key'=>'moveout',      'title'=>'Certification of Move-Out',         'icon'=>'fa-truck-moving',       'placeholder'=>'e.g. Transfer of residence',          'body'=>'moveout'],
    ['key'=>'movein',       'title'=>'Certification of Move-In',          'icon'=>'fa-sign-in-alt',        'placeholder'=>'e.g. New resident, Transfer',         'body'=>'movein'],
    ['key'=>'closure',      'title'=>'Certification of Business Closure', 'icon'=>'fa-store-slash',        'placeholder'=>'e.g. Cessation of business',          'body'=>'closure'],
    ['key'=>'latereg',      'title'=>'Certificate of Late Registration',  'icon'=>'fa-clock',              'placeholder'=>'e.g. PSA requirement',                'body'=>'latereg'],
    ['key'=>'guardianship', 'title'=>'Certificate of Guardianship',       'icon'=>'fa-user-shield',        'placeholder'=>'e.g. School enrollment',              'body'=>'guardianship'],
    ['key'=>'cohabitation', 'title'=>'Certificate of Cohabitation',       'icon'=>'fa-user-friends',       'placeholder'=>'e.g. SSS, PhilHealth benefit',        'body'=>'cohabitation'],
    ['key'=>'katibayan',    'title'=>'Barangay Certification',            'icon'=>'fa-stamp',              'placeholder'=>'e.g. Educational Assistance, Loan',   'body'=>'katibayan'],
    ['key'=>'cashgift',     'title'=>'Pagpapatunay para sa Cash Gift',    'icon'=>'fa-gift',               'placeholder'=>'e.g. Birthday cash gift',             'body'=>'cashgift'],
    ['key'=>'yumao',        'title'=>'Pagpapatunay para sa Yumao',        'icon'=>'fa-ribbon',             'placeholder'=>'e.g. Death certificate requirement',  'body'=>'yumao'],
    ['key'=>'oath',         'title'=>'Oath of Office',                    'icon'=>'fa-hand-holding-heart', 'placeholder'=>'e.g. Assumption of office',           'body'=>'oath'],
];
@endphp

@foreach($docConfigs as $doc)
<div x-show="openDoc === '{{ $doc['key'] }}'" x-cloak class="modal-ov" x-transition style="z-index:110;">
    <div class="modal-box" @click.away="openDoc=''">
        <div class="modal-in">
            <div class="modal-hd">
                <div class="modal-ttl">
                    <div class="modal-ttl-ico"><i class="fas {{ $doc['icon'] }}"></i></div>
                    <div>
                        <div>{{ $doc['title'] }}</div>
                        <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;letter-spacing:0;">Barangay San Miguel II</div>
                    </div>
                </div>
                <button @click="openDoc=''; clearDocOwner()" class="modal-close"><i class="fas fa-times-circle"></i></button>
            </div>
            <div class="section-blk" @click.away="docOwnerOpen=false">
                <div class="section-blk-ttl"><i class="fas fa-search"></i> Select Resident</div>
                <div style="position:relative;">
                    <div style="display:flex;align-items:center;background:#fff;border:1.5px solid var(--border);border-radius:9px;padding:9px 13px;gap:7px;">
                        <i class="fas fa-search" style="color:var(--light);font-size:11px;flex-shrink:0;"></i>
                        <input type="text" x-model="docOwnerSearch"
                               @focus="docOwnerOpen=true" @input="docOwnerOpen=true; docOwnerSelectedId=null; docOwnerName=docOwnerSearch"
                               placeholder="Type name, code, or walk-in..." autocomplete="off"
                               style="flex:1;border:none;background:transparent;font-family:inherit;font-size:12px;font-weight:600;color:var(--text);outline:none;">
                        <span x-show="docOwnerSelectedId && docOwnerIsVoter" style="font-size:9px;background:#dcfce7;color:#15803d;font-weight:900;padding:2px 8px;border-radius:99px;"><i class="fas fa-check-circle"></i> Voter — FREE</span>
                        <span x-show="docOwnerSelectedId && !docOwnerIsVoter" style="font-size:9px;background:#fef3c7;color:#a16207;font-weight:900;padding:2px 8px;border-radius:99px;"><i class="fas fa-coins"></i> Non-Voter</span>
                        <button type="button" x-show="docOwnerSearch" @click="clearDocOwner()" style="background:none;border:none;color:var(--light);cursor:pointer;font-size:11px;"><i class="fas fa-times"></i></button>
                    </div>
                    <div x-show="docOwnerOpen && docResidentSuggestions.length > 0" x-transition class="suggestions-box">
                        <template x-for="r in docResidentSuggestions" :key="r.id">
                            <div @click="selectDocResident(r)" class="sugg-item">
                                <div style="flex:1;"><div class="sugg-name" x-text="r.name"></div><div class="sugg-meta" x-text="r.code+' • '+(r.address||'No address')"></div></div>
                                <span x-show="r.is_voter" class="pill pill-voter">Voter</span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            <div class="fgrid2 fgrp">
                <div><label class="flbl">Purpose</label><input type="text" x-model="docPurpose" placeholder="{{ $doc['placeholder'] }}" class="finput"></div>
                <div><label class="flbl">Date of Issue</label><input type="date" x-model="docDate" class="finput"></div>
            </div>
            <div class="fgrid2 fgrp">
                <div class="fspan2"><label class="flbl">Full Name</label><input type="text" x-model="docOwnerName" placeholder="Full name..." class="finput"></div>
                <div class="fspan2"><label class="flbl">Address</label><input type="text" x-model="docOwnerAddress" placeholder="Blk/Lot, Street, Barangay..." class="finput"></div>
                <div class="fspan2" style="display: grid; grid-template-columns: 2fr 1fr; gap: 10px;">
                    <div>
                        <label class="flbl">Date of Birth</label>
                        <input type="date" x-model="docOwnerBdayRaw"
                               @change="const bd=new Date($event.target.value);const t=new Date();let a=t.getFullYear()-bd.getFullYear();const m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;docOwnerAge=a;docOwnerBday=bd.toLocaleDateString('en-PH',{year:'numeric',month:'long',day:'numeric'})"
                               class="finput">
                    </div>
                    <div>
                        <label class="flbl">Age</label>
                        <input type="number" x-model="docOwnerAge" class="finput" placeholder="Age">
                    </div>
                </div>
                <div><label class="flbl">Place of Birth</label><input type="text" x-model="docOwnerBirthplace" placeholder="City/Province..." class="finput"></div>
                <div><label class="flbl">Issued By</label><input type="text" x-model="docIssuedBy" placeholder="Name of staff..." class="finput"></div>
                <div><label class="flbl">Position</label><input type="text" x-model="docPosition" placeholder="e.g. Barangay BRK..." class="finput"></div>
            </div>
            @if($doc['body']==='endorsement')
            <div class="section-blk"><div class="section-blk-ttl">Endorsement Details</div>
                <div><label class="flbl">Residing Since (Year)</label><input type="text" x-model="docResidenceSince" placeholder="e.g. 2020" class="finput"></div>
            </div>
            @endif
            @if($doc['body']==='moveout'||$doc['body']==='movein')
            <div class="section-blk"><div class="section-blk-ttl">{{ $doc['body']==='moveout'?'Move-Out':'Move-In' }} Details</div>
                <div class="fgrid2" style="gap:9px;">
                    <div><label class="flbl">Blk</label><input type="text" x-model="docBlk" class="finput"></div>
                    <div><label class="flbl">Lot</label><input type="text" x-model="docLot" class="finput"></div>
                    <div><label class="flbl">{{ $doc['body']==='moveout'?'Move-Out Date':'Move-In Date' }}</label><input type="text" x-model="docMoveDate" placeholder="e.g. Feb 9, 2023" class="finput"></div>
                    <div><label class="flbl">Landlord / Owner</label><input type="text" x-model="docLandlordName" class="finput"></div>
                    <div><label class="flbl">Rental Agreement Date</label><input type="text" x-model="docRentalDate" class="finput"></div>
                    <div class="fspan2"><label class="flbl">Family Members (comma-separated)</label><input type="text" x-model="docFamilyMembers" class="finput"></div>
                </div>
            </div>
            @endif
            @if($doc['body']==='yumao')
            <div class="section-blk"><div class="section-blk-ttl"><i class="fas fa-ribbon"></i> Yumao Details</div>
                <div class="fgrid2" style="gap:9px;">
                    <div><label class="flbl">Blk</label><input type="text" x-model="docBlk" class="finput"></div>
                    <div><label class="flbl">Lot</label><input type="text" x-model="docLot" class="finput"></div>
                    <div class="fspan2"><label class="flbl">Pangalan ng Yumao (Full Name of Deceased)</label><input type="text" x-model="docClaimantName" placeholder="Buong pangalan ng namatay..." class="finput"></div>
                    <div><label class="flbl">Pangalan ng Kumuha (Claimant)</label><input type="text" x-model="docOwnerName" placeholder="Pangalan ng kukuha ng benepisyo..." class="finput"></div>
                    <div><label class="flbl">Relasyon sa Yumao</label><input type="text" x-model="docClaimantRelation" placeholder="e.g. Asawa, Anak, Kapatid..." class="finput"></div>
                </div>
            </div>
            @endif
            @if($doc['body']==='cashgift')
            <div class="section-blk"><div class="section-blk-ttl"><i class="fas fa-gift"></i> Cash Gift Details</div>
                <div class="fgrid2" style="gap:9px;">
                    <div class="fspan2"><label class="flbl">Pangalan ng May Karamdaman (Full Name)</label><input type="text" x-model="docClaimantName" placeholder="Pangalan ng may sakit..." class="finput"></div>
                    <div><label class="flbl">Pangalan ng Kukuha (Claimant)</label><input type="text" x-model="docSpouseName" placeholder="Pangalan ng kukuha..." class="finput"></div>
                    <div><label class="flbl">Relasyon</label><input type="text" x-model="docClaimantRelation" placeholder="e.g. Anak, Asawa, Apo..." class="finput"></div>
                    <div><label class="flbl">Birthday Month</label><input type="text" x-model="docBirthMonth" placeholder="e.g. February" class="finput"></div>
                    <div><label class="flbl">Birthday Year</label><input type="text" x-model="docBirthYear" placeholder="e.g. 2025" class="finput"></div>
                </div>
            </div>
            @endif
            @if($doc['body']==='closure')
            <div class="section-blk"><div class="section-blk-ttl">Business Closure Details</div>
                <div class="fgrid2" style="gap:9px;">
                    <div><label class="flbl">Company / Trade Name</label><input type="text" x-model="docCompanyName" class="finput"></div>
                    <div><label class="flbl">Business Owner</label><input type="text" x-model="docOwnerBusiness" class="finput"></div>
                    <div><label class="flbl">Non-Operational Since (mm/dd/yy)</label><input type="text" x-model="docNonOpSince" placeholder="e.g. 01/15/25" class="finput"></div>
                </div>
            </div>
            @endif
            @if($doc['body']==='latereg')
            <div class="section-blk"><div class="section-blk-ttl">Late Registration Details</div>
                <div class="fgrid2" style="gap:9px;">
                    <div class="fspan2"><label class="flbl">Child's Full Name</label><input type="text" x-model="docChildName" class="finput"></div>
                    <div><label class="flbl">Father's Full Name</label><input type="text" x-model="docFatherName" class="finput"></div>
                    <div><label class="flbl">Mother's Full Name</label><input type="text" x-model="docMotherName" class="finput"></div>
                    <div><label class="flbl">Birth Attendant</label><input type="text" x-model="docBirthAttendant" class="finput"></div>
                    <div><label class="flbl">Born From (Place)</label><input type="text" x-model="docBornFrom" class="finput"></div>
                </div>
            </div>
            @endif
            @if($doc['body']==='guardianship')
            <div class="section-blk"><div class="section-blk-ttl">Guardianship Details</div>
                <div class="fgrid3" style="gap:9px;">
                    <div><label class="flbl">Blk</label><input type="text" x-model="docBlk" class="finput"></div>
                    <div><label class="flbl">Lot</label><input type="text" x-model="docLot" class="finput"></div>
                    <div><label class="flbl">Ward's Age</label><input type="text" x-model="docWardAge" class="finput"></div>
                    <div style="grid-column:span 2;"><label class="flbl">Ward's Full Name</label><input type="text" x-model="docWardName" class="finput"></div>
                    <div><label class="flbl">Relation to Guardian</label><input type="text" x-model="docWardRelation" class="finput"></div>
                </div>
            </div>
            @endif
            @if($doc['body']==='cohabitation')
            <div class="section-blk"><div class="section-blk-ttl">Cohabitation Details</div>
                <div class="fgrid3" style="gap:9px;">
                    <div class="fspan3"><label class="flbl">Partner's Full Name</label><input type="text" x-model="docPartnerName" class="finput"></div>
                    <div><label class="flbl">Blk</label><input type="text" x-model="docBlk" class="finput"></div>
                    <div><label class="flbl">Lot</label><input type="text" x-model="docLot" class="finput"></div>
                    <div><label class="flbl">Living Together Since</label><input type="text" x-model="docLivingSince" placeholder="e.g. 2024" class="finput"></div>
                </div>
            </div>
            @endif
            @if($doc['body']==='katibayan')
            <div class="section-blk"><div class="section-blk-ttl">Katibayan Details</div>
                <div class="fgrid2" style="gap:9px;">
                    <div><label class="flbl">Blk</label><input type="text" x-model="docBlk" class="finput"></div>
                    <div><label class="flbl">Lot</label><input type="text" x-model="docLot" class="finput"></div>
                </div>
            </div>
            @endif
            @php
                $curTpl = $documentTemplates[$doc['key']] ?? null;
                $hasCustomTpl = !empty($curTpl['is_custom']);
            @endphp

            {{-- Template Toolbar & Inline Editor --}}
            <div style="margin-bottom:14px; padding:10px 14px; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:10px;"
                 x-data="{ showTplEditor: false, savingTpl: false }">
                <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:8px;">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:11px; font-weight:800; color:#0f172a; display:flex; align-items:center; gap:6px;">
                            <i class="fas fa-file-signature" style="color:#0E5393;"></i> Document Template:
                        </span>
                        @if($hasCustomTpl)
                            <span style="font-size:9px; background:#dcfce7; color:#15803d; border:1px solid #86efac; font-weight:900; padding:2px 8px; border-radius:99px;">
                                <i class="fas fa-check-circle"></i> Custom Template Active
                            </span>
                        @else
                            <span style="font-size:9px; background:#f1f5f9; color:#64748b; font-weight:800; padding:2px 8px; border-radius:99px;">
                                Standard Barangay Default
                            </span>
                        @endif
                    </div>

                    <div style="display:flex; align-items:center; gap:6px;">
                        <button type="button" @click="showTplEditor = !showTplEditor" class="btn-plain btn-sm"
                                style="background:#eff6ff; color:#1d4ed8; border:1.5px solid #bfdbfe; font-size:10px; font-weight:800; padding:5px 11px; border-radius:8px; cursor:pointer; display:inline-flex; align-items:center; gap:5px;"
                                title="Click to customize wording or upload official letterhead">
                            <i class="fas fa-edit"></i> <span x-text="showTplEditor ? 'Close Editor' : 'Edit / Upload Template'"></span>
                        </button>

                        @if($hasCustomTpl)
                        <button type="button" @click="resetTemplate('{{ $doc['key'] }}')" class="btn-plain btn-sm"
                                style="background:#fef2f2; color:#dc2626; border:1px solid #fca5a5; font-size:10px; font-weight:800; padding:5px 10px; border-radius:8px; cursor:pointer; display:inline-flex; align-items:center; gap:4px;"
                                title="Revert back to default barangay layout">
                            <i class="fas fa-undo"></i> Reset Default
                        </button>
                        @endif
                    </div>
                </div>

                {{-- Template Editor Drawer --}}
                <div x-show="showTplEditor" x-cloak style="margin-top:12px; padding:14px; background:#fff; border:1.5px solid #bfdbfe; border-radius:10px; box-shadow:0 4px 12px rgba(14,83,147,0.06);">
                    <form @submit.prevent="saveTemplate('{{ $doc['key'] }}', $el)" enctype="multipart/form-data">
                        <div style="font-size:11.5px; font-weight:900; color:#0E5393; text-transform:uppercase; letter-spacing:.04em; margin-bottom:6px; display:flex; align-items:center; gap:6px;">
                            <i class="fas fa-sliders-h"></i> Customize {{ $doc['title'] }} Template
                        </div>
                        <p style="font-size:10px; color:#64748b; font-weight:600; margin-bottom:12px; line-height:1.4;">
                            Kapag may pagbabago sa opisyal na template o wording ng Barangay, i-edit ang fields o mag-upload ng scanned official letterhead/background. Awtomatikong mag-a-update ang document preview at printout.
                        </p>

                        <div class="fgrid2" style="gap:10px; margin-bottom:10px;">
                            <div>
                                <label class="flbl">Document Title</label>
                                <input type="text" name="title" value="{{ $curTpl['title'] ?? $doc['title'] }}" class="finput">
                            </div>
                            <div>
                                <label class="flbl">Punong Barangay Signatory</label>
                                <input type="text" name="captain_name" value="{{ $curTpl['captain_name'] ?? 'MARVIN M. BENIS' }}" class="finput">
                            </div>
                        </div>

                        <div class="fgrid2" style="gap:10px; margin-bottom:10px;">
                            <div>
                                <label class="flbl">Province / Line 1</label>
                                <input type="text" name="header_line1" value="{{ $curTpl['header_line1'] ?? 'PROVINCE OF CAVITE' }}" class="finput">
                            </div>
                            <div>
                                <label class="flbl">City / Line 2</label>
                                <input type="text" name="header_line2" value="{{ $curTpl['header_line2'] ?? 'CITY OF DASMARIÑAS' }}" class="finput">
                            </div>
                            <div>
                                <label class="flbl">Barangay / Line 3</label>
                                <input type="text" name="header_line3" value="{{ $curTpl['header_line3'] ?? 'BARANGAY SAN MIGUEL 2' }}" class="finput">
                            </div>
                            <div>
                                <label class="flbl">Office / Line 4</label>
                                <input type="text" name="header_line4" value="{{ $curTpl['header_line4'] ?? 'OFFICE OF THE SANGGUNIANG BARANGAY' }}" class="finput">
                            </div>
                        </div>

                        <div style="margin-bottom:10px;">
                            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:4px; flex-wrap:wrap; gap:4px;">
                                <label class="flbl" style="margin:0;">Custom Body Text / Wording (Optional override)</label>
                                <div style="font-size:9px; color:#64748b; display:flex; align-items:center; gap:3px; flex-wrap:wrap;">
                                    <span>Click tag:</span>
                                    <button type="button" @click="insertTag($el, '{NAME}')" class="pill" style="cursor:pointer; border:1px solid #cbd5e1; background:#f8fafc; font-size:8.5px; padding:1px 6px;">{NAME}</button>
                                    <button type="button" @click="insertTag($el, '{AGE}')" class="pill" style="cursor:pointer; border:1px solid #cbd5e1; background:#f8fafc; font-size:8.5px; padding:1px 6px;">{AGE}</button>
                                    <button type="button" @click="insertTag($el, '{ADDRESS}')" class="pill" style="cursor:pointer; border:1px solid #cbd5e1; background:#f8fafc; font-size:8.5px; padding:1px 6px;">{ADDRESS}</button>
                                    <button type="button" @click="insertTag($el, '{PURPOSE}')" class="pill" style="cursor:pointer; border:1px solid #cbd5e1; background:#f8fafc; font-size:8.5px; padding:1px 6px;">{PURPOSE}</button>
                                    <button type="button" @click="insertTag($el, '{DATE}')" class="pill" style="cursor:pointer; border:1px solid #cbd5e1; background:#f8fafc; font-size:8.5px; padding:1px 6px;">{DATE}</button>
                                </div>
                            </div>
                            <textarea name="body_template" class="finput" rows="4" style="font-family:'Times New Roman',serif; font-size:12px; line-height:1.5;" placeholder="Iwanang blangko upang gamitin ang standard barangay wording, o mag-type ng custom paragraphs na may tags tulad ng {NAME}, {AGE}, {ADDRESS}, {PURPOSE}.">{{ $curTpl['body_template'] ?? '' }}</textarea>
                        </div>

                        <div class="fgrid2" style="gap:10px; margin-bottom:12px;">
                            <div>
                                <label class="flbl"><i class="fas fa-image"></i> Upload Official Letterhead / Template Image (PNG/JPG)</label>
                                <input type="file" name="custom_bg" accept="image/png,image/jpeg,image/jpg" class="finput" style="padding:5px;">
                                @if(!empty($curTpl['custom_bg_path']))
                                    <div style="font-size:9px; color:#15803d; margin-top:3px; display:flex; align-items:center; gap:4px;">
                                        <i class="fas fa-check"></i> Uploaded header/background: <a href="{{ asset('storage/'.$curTpl['custom_bg_path']) }}" target="_blank" style="text-decoration:underline; font-weight:700;">View Letterhead</a>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <label class="flbl">Footer Dry Seal Note</label>
                                <input type="text" name="footer_note" value="{{ $curTpl['footer_note'] ?? 'NOTE: THIS CERTIFICATION IS NOT VALID IF THERE ARE ERASURE AND WITHOUT DRY SEAL' }}" class="finput">
                            </div>
                        </div>

                        <div style="display:flex; justify-content:flex-end; gap:8px;">
                            <button type="button" @click="showTplEditor = false" class="btn-plain btn-ghost btn-sm">Cancel</button>
                            <button type="submit" class="btn-grad btn-sm">
                                <i class="fas fa-save"></i> Save &amp; Apply Template
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="print-{{ $doc['key'] }}" class="doc-preview">
                @if(!empty($curTpl['custom_bg_path']))
                    <div style="text-align:center; margin-bottom:12px;">
                        <img src="{{ asset('storage/'.$curTpl['custom_bg_path']) }}" style="max-width:100%; max-height:130px; object-fit:contain; margin-bottom:8px;">
                        <div style="border-top:2px solid #000;border-bottom:2px solid #000;margin:8px 0;padding:4px 0;">
                            <p style="font-size:13px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:.05em;margin:0;">{{ $curTpl['title'] ?? $doc['title'] }}</p>
                        </div>
                    </div>
                @else
                    <div style="text-align:center;margin-bottom:14px;">
                        <div style="display:flex;align-items:center;justify-content:center;gap:10px;margin-bottom:7px;">
                            <img src="{{ asset('images/dasma.png') }}" style="width:52px;height:52px;object-fit:contain;" onerror="this.style.display='none'">
                            <img src="{{ asset('images/Bagong_Pilipinas_logo.png') }}" style="width:52px;height:52px;object-fit:contain;" onerror="this.style.display='none'">
                            <img src="{{ asset('images/brgysm2_logo.png') }}" style="width:52px;height:52px;object-fit:contain;" onerror="this.style.display='none'">
                        </div>
                        <p style="font-size:10.5px;font-weight:700;color:#333;margin:1px 0;">{{ $curTpl['header_line1'] ?? 'PROVINCE OF CAVITE' }}</p>
                        <p style="font-size:10.5px;font-weight:700;color:#333;margin:1px 0;">{{ $curTpl['header_line2'] ?? 'CITY OF DASMARIÑAS' }}</p>
                        <p style="font-size:10.5px;font-weight:700;color:#333;margin:1px 0;">{{ $curTpl['header_line3'] ?? 'BARANGAY SAN MIGUEL 2' }}</p>
                        <p style="font-size:9.5px;color:#666;margin:1px 0;">{{ $curTpl['header_line4'] ?? 'OFFICE OF THE SANGGUNIANG BARANGAY' }}</p>
                        <div style="border-top:2px solid #000;border-bottom:2px solid #000;margin:8px 0;padding:4px 0;">
                            <p style="font-size:13px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:.05em;margin:0;">{{ $curTpl['title'] ?? $doc['title'] }}</p>
                        </div>
                    </div>
                @endif
                <div style="color:#000;line-height:1.6;font-size:10.5px;">
                    @if(!empty($curTpl['body_template']))
                        <div x-html="renderTemplateBody(`{!! addslashes($curTpl['body_template']) !!}`, $data)" style="white-space: pre-wrap; margin-bottom: 10px; line-height: 1.6;"></div>
                    @elseif($doc['body']==='residency')
                    <p>To whom it may concern,</p>
                    <p style="text-indent:40px;margin-top:6px;">This is to certify that <strong><span x-text="docOwnerName||'______________________________'"></span></strong>, born on <strong><span x-text="docOwnerBday||'__________________'"></span></strong>, <strong><span x-text="docOwnerAge||'___'"></span></strong> years old, is a bona fide resident of <strong>Barangay San Miguel II, Dasmariñas City, Cavite.</strong></p>
                    <p style="text-indent:40px;margin-top:6px;">The undersigned has certified that after a reasonable inquiry, I have verified the authenticity of barangay residency showing that the applicant has been residing in the barangay for at least six (6) months prior to the application.</p>
                    <p style="text-indent:40px;margin-top:6px;">This certificate is issued upon the request of the above named person as a supporting document for <strong><span x-text="docPurpose||'______________________________'"></span></strong>.</p>
                    @elseif($doc['body']==='indigency')
                    <p>To whom it may concern:</p>
                    <p style="text-indent:40px;margin-top:6px;">This is to certify that <strong><span x-text="docOwnerName||'______________________________'"></span></strong>, <strong><span x-text="docOwnerAge||'___'"></span></strong> of legal age is a bona fide resident of <strong>Barangay San Miguel II, City of Dasmarinas Cavite.</strong></p>
                    <p style="text-indent:40px;margin-top:6px;">This further certifies that the family above-mentioned belongs to the less fortunate or accredited indigent families in the area of our jurisdiction.</p>
                    <p style="text-indent:40px;margin-top:6px;">This certification is being issued upon request of <strong><span x-text="docOwnerName||'______________________________'"></span></strong> for <strong><span x-text="docPurpose||'______________________________'"></span></strong> purpose only.</p>
                    @elseif($doc['body']==='clearance')
                    <div style="overflow:hidden;">
                        <label style="float:right;cursor:pointer;margin-left:12px;" title="Click to upload photo">
                            <div style="border:1px solid #000;border-radius:8px;width:78px;height:88px;display:flex;align-items:center;justify-content:center;flex-direction:column;overflow:hidden;position:relative;background:#f5f5f5;">
                                <img x-show="docClearancePhoto" :src="docClearancePhoto" style="width:100%;height:100%;object-fit:cover;position:absolute;top:0;left:0;">
                                <div x-show="!docClearancePhoto" style="text-align:center;font-size:8px;color:#999;">📷<br>Upload</div>
                            </div>
                            <input type="file" accept="image/*" style="display:none;" @change="const f=$event.target.files[0];if(f){const r=new FileReader();r.onload=e=>docClearancePhoto=e.target.result;r.readAsDataURL(f)}">
                        </label>
                        <p>To whom it may concern,</p>
                        <p style="text-indent:30px;">This is to certify that the person whose name, picture, signature and thumb mark appear below has requested a Barangay Clearance from this office.</p>
                    </div>
                    <div style="margin-top:9px;">
                        <p>NAME: <span style="border-bottom:1px solid #000;display:inline-block;min-width:220px;" x-text="docOwnerName||''"></span></p>
                        <p>ADDRESS: <span style="border-bottom:1px solid #000;display:inline-block;min-width:200px;" x-text="docOwnerAddress||''"></span></p>
                        <p>DATE OF BIRTH: <span style="border-bottom:1px solid #000;display:inline-block;min-width:140px;" x-text="docOwnerBday||''"></span></p>
                        <p>PLACE OF BIRTH: <span style="border-bottom:1px solid #000;display:inline-block;min-width:140px;" x-text="docOwnerBirthplace||''"></span></p>
                        <p>AGE: <span style="border-bottom:1px solid #000;display:inline-block;min-width:60px;" x-text="docOwnerAge||''"></span></p>
                        <p>CITIZENSHIP: <span style="border-bottom:1px solid #000;display:inline-block;min-width:120px;">FILIPINO</span></p>
                        <p>PURPOSE: <span style="border-bottom:1px solid #000;display:inline-block;min-width:200px;" x-text="docPurpose||''"></span></p>
                        <p>DATE ISSUED: <span style="border-bottom:1px solid #000;display:inline-block;min-width:120px;" x-text="formatDocDate(docDate)"></span></p>
                    </div>
                    <p style="margin-top:7px;font-style:italic;font-size:10px;"><em>This certification is valid for thirty (30) days from the date issued.</em></p>
                    @elseif($doc['body']==='cashgift')
                    <p>Sa lahat ng makababasa nito:</p>
                    <p style="text-indent:40px;margin-top:6px;">Ito ay bilang pagpapatunay na si <strong><span x-text="docClaimantName||'______________________________'"></span></strong> ay may karamdaman at walang kakayahang makuha ang kanyang Birthday Cash Gift.</p>
                    <p style="text-indent:40px;margin-top:6px;">Pinahihintulutan niya ang kanyang <strong><span x-text="docClaimantRelation||'______________'"></span></strong> na si <strong><span x-text="docSpouseName||'______________________________'"></span></strong> na makuha ang kanyang Birthday Cash Gift para sa buwan ng <strong><span x-text="docBirthMonth||'__________'"></span></strong>, taong <strong><span x-text="docBirthYear||'______'"></span></strong>.</p>
                    <p style="text-indent:40px;margin-top:6px;">Pang-unawa po ang aming hiling. Maraming salamat po.</p>
                    @elseif($doc['body']==='yumao')
                    <p>Sa lahat ng makababasa nito:</p>
                    <p style="text-indent:40px;margin-top:6px;">Ito ay nagpapatunay na si <strong><span x-text="docClaimantName||'______________________________'"></span></strong>, naninirahan sa <strong>Blk <span x-text="docBlk||'___'"></span> Lot <span x-text="docLot||'___'"></span>, Barangay San Miguel II, Dasmariñas City, Cavite</strong>, ay pumanaw na.</p>
                    <p style="text-indent:40px;margin-top:6px;">Ang kanyang <strong><span x-text="docClaimantRelation||'______________'"></span></strong> na si <strong><span x-text="docOwnerName||'______________________________'"></span></strong> ay awtorisadong kumuha ng anumang benepisyo o dokumento sa ngalan ng namatay.</p>
                    <p style="text-indent:40px;margin-top:6px;">Pinagkakaloob ang sertipikasyong ito para sa lahat ng legal na layunin.</p>
                    @else
                    <p style="text-indent:40px;">This is to certify that <strong><span x-text="docOwnerName||'______________________________'"></span></strong>, <strong><span x-text="docOwnerAge||'___'"></span></strong> years old, a bona fide resident of <strong>Barangay San Miguel II</strong>, is hereby issued this <strong>{{ $curTpl['title'] ?? $doc['title'] }}</strong> for <strong><span x-text="docPurpose||'______________________________'"></span></strong>.</p>
                    <p style="text-indent:40px;margin-top:6px;">This certification is being issued upon request of the above-named person for whatever legal purpose it may serve.</p>
                    @endif
                    <p style="margin-top:10px;">Issued this <strong><span x-text="docDayOrdinal"></span></strong> day of <strong><span x-text="docMonth"></span></strong>, year <strong><span x-text="docYear"></span></strong> at Barangay San Miguel II, Dasmariñas City, Cavite.</p>
                </div>
                <div style="text-align:right;margin-top:46px;">
                    <div style="display:inline-block;text-align:center;min-width:195px;">
                        <div style="height:38px;"></div>
                        <div style="border-top:2px solid #000;padding-top:3px;">
                            <p style="font-weight:900;text-transform:uppercase;margin:0;font-size:10.5px;">{{ $curTpl['captain_name'] ?? 'MARVIN M. BENIS' }}</p>
                            <p style="font-style:italic;margin:0;font-size:9.5px;">{{ $curTpl['captain_title'] ?? 'PUNONG BARANGAY' }}</p>
                        </div>
                    </div>
                </div>
                <div style="margin-top:7px;font-size:10px;color:#666;">
                    <p>Issued by: <span style="border-bottom:1px solid #aaa;display:inline-block;min-width:148px;" x-text="docIssuedBy||''"></span></p>
                    <p>Position: <span style="border-bottom:1px solid #aaa;display:inline-block;min-width:148px;" x-text="docPosition||''"></span></p>
                </div>
                <div style="margin-top:10px;border-top:1px solid #ccc;padding-top:7px;text-align:center;">
                    <p style="font-size:8.5px;color:#888;text-transform:uppercase;letter-spacing:.05em;font-style:italic;">{{ $curTpl['footer_note'] ?? 'NOTE: THIS CERTIFICATION IS NOT VALID IF THERE ARE ERASURE AND WITHOUT DRY SEAL' }}</p>
                </div>
            </div>
            <div style="display:flex;justify-content:flex-end;gap:9px;">
                <button @click="openDoc=''; clearDocOwner()" class="btn-plain btn-edit">Cancel</button>
                @php $dk = $doc['key']; @endphp
                <button onclick="printDoc('print-{{ $dk }}')" class="btn-grad"><i class="fas fa-print"></i> Print Document</button>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- ══ PROFILE MODAL ══ --}}
<div x-show="showProfile" x-cloak class="modal-ov" x-transition>
    <div class="modal-box" @click.away="showProfile=false">
        <div class="modal-in">
            <div class="modal-hd">
                <div class="modal-ttl"><div class="modal-ttl-ico"><i class="fas fa-user-circle"></i></div> Resident Profile</div>
                <button @click="showProfile=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
            </div>
            <div style="display:flex;align-items:center;gap:18px;margin-bottom:18px;padding-bottom:18px;border-bottom:1px solid var(--border);">
                <img :src="selectedUser.photo||'https://ui-avatars.com/api/?name='+encodeURIComponent(selectedUser.name||'')+'&background=0E5393&color=fff&size=128&bold=true'"
                     style="width:80px !important;height:80px !important;border-radius:15px;object-fit:cover;box-shadow:var(--card-shadow);border:3px solid #fff;flex-shrink:0;aspect-ratio:1/1;">
                <div>
                    <div style="font-size:20px;font-weight:900;color:var(--text);line-height:1.2;" x-text="selectedUser.name"></div>
                    <div style="font-size:10px;font-weight:700;color:var(--brand);text-transform:uppercase;letter-spacing:.06em;margin-top:3px;" x-text="selectedUser.code"></div>
                    <div style="display:flex;gap:4px;flex-wrap:wrap;margin-top:7px;">
                        <span x-show="selectedUser.is_senior" class="pill pill-senior">Senior</span>
                        <span x-show="selectedUser.is_pwd" class="pill pill-pwd">PWD</span>
                        <span x-show="selectedUser.is_bedridden" class="pill pill-pwd" style="background:#fee2e2;color:#dc2626;">Bed-ridden</span>
                        <span x-show="selectedUser.is_single_parent" class="pill pill-solo">Solo Parent</span>
                        <span x-show="selectedUser.is_voter" class="pill pill-voter">Voter</span>
                        <span x-show="selectedUser.is_student" class="pill pill-student">Student</span>
                    </div>
                </div>
            </div>
            <div class="fgrid2" style="gap:9px;margin-bottom:14px;">
                <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Birthday</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="formatDate(selectedUser.birthday)"></div></div>
                <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Age</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="getAge(selectedUser.birthday)"></div></div>
                <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Birthplace</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedUser.birthplace||'N/A'"></div></div>
                <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Gender</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedUser.gender||'N/A'"></div></div>
                <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Civil Status</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedUser.civil_status||'N/A'"></div></div>
                <div x-show="selectedUser.civil_status === 'Married'" style="background:#fdf2ff;padding:11px 13px;border-radius:9px;border:1px solid #e9d5ff;"><div style="font-size:9px;font-weight:900;color:#7c3aed;text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Spouse / Husband</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedUser.spouse_name||'N/A'"></div></div>
                <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Contact No.</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedUser.contact||'N/A'"></div></div>
                <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Email</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedUser.email||'N/A'"></div></div>
                <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Occupation</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedUser.occupation||'N/A'"></div></div>
                <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);grid-column:span 2;"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Address</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedUser.address||'N/A'"></div></div>
            </div>
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:11px;padding:13px;margin-bottom:14px;">
                <div style="font-size:9px;font-weight:900;color:var(--brand-dark);text-transform:uppercase;letter-spacing:.07em;margin-bottom:9px;"><i class="fas fa-users" style="margin-right:4px;color:var(--brand);"></i> Family Members</div>
                <div style="display:flex;flex-wrap:wrap;gap:5px;">
                    <template x-for="fm in (() => {
                        const byHousehold = allResidents.filter(r => r.id !== selectedUser.id && (r.household_head_id == selectedUser.id || (selectedUser.household_head_id && (r.id == selectedUser.household_head_id || r.household_head_id == selectedUser.household_head_id))));
                        const spouseName = (selectedUser.spouse_name || '').trim().toLowerCase();
                        const spouseByName = spouseName ? allResidents.filter(r => r.id !== selectedUser.id && !byHousehold.find(f => f.id === r.id) && (r.first_name + ' ' + r.last_name).trim().toLowerCase() === spouseName) : [];
                        return [...byHousehold, ...spouseByName];
                    })()" :key="fm.id">
                        <div style="display:inline-flex;align-items:center;gap:4px;background:#fff;padding:4px 9px;border-radius:99px;border:1px solid #cbd5e1;font-size:10px;font-weight:800;color:#333;">
                            <i class="fas fa-user" style="color:var(--brand);font-size:8px;"></i> 
                            <span x-text="fm.first_name + ' ' + fm.last_name + ' (' + ((fm.id == selectedUser.household_head_id || fm.is_household_head) ? 'Head' : (selectedUser.civil_status === 'Married' && (selectedUser.spouse_name || '').trim().toLowerCase() === (fm.first_name + ' ' + fm.last_name).trim().toLowerCase()) ? 'Spouse' : (fm.civil_status === 'Married' && (fm.spouse_name || '').trim().toLowerCase() === (selectedUser.first_name + ' ' + selectedUser.last_name).trim().toLowerCase()) ? 'Spouse' : (fm.relationship || 'Member')) + ')'" ></span>
                            <span x-show="fm.verification_status === 'pending'" style="font-size:8px;opacity:.8;color:#d97706;background:#fef3c7;padding:1px 4px;border-radius:3px;margin-left:4px;" title="Awaiting office approval">(Pending)</span>
                        </div>
                    </template>
                    <span x-show="(() => {
                        const byHousehold = allResidents.filter(r => r.id !== selectedUser.id && (r.household_head_id == selectedUser.id || (selectedUser.household_head_id && (r.id == selectedUser.household_head_id || r.household_head_id == selectedUser.household_head_id))));
                        const spouseName = (selectedUser.spouse_name || '').trim().toLowerCase();
                        const spouseByName = spouseName ? allResidents.filter(r => r.id !== selectedUser.id && !byHousehold.find(f => f.id === r.id) && (r.first_name + ' ' + r.last_name).trim().toLowerCase() === spouseName) : [];
                        return byHousehold.length + spouseByName.length === 0;
                    })()" style="font-size:10px;color:var(--light);font-weight:600;">No family members found.</span>
                </div>
            </div>
            <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:11px;padding:13px;margin-bottom:14px;">
                <div style="font-size:9px;font-weight:900;color:var(--brand-dark);text-transform:uppercase;letter-spacing:.07em;margin-bottom:9px;"><i class="fas fa-paw" style="margin-right:4px;color:var(--brand);"></i> Beloved Pet Family</div>
                <div style="display:flex;flex-wrap:wrap;gap:5px;">
                    @foreach($pets ?? [] as $rp)
                    <div x-show="selectedUser.id == {{ $rp->resident_id }}"
                         style="display:flex;align-items:center;gap:4px;background:#fff;padding:4px 9px;border-radius:99px;border:1px solid #bfdbfe;font-size:10px;font-weight:800;color:#333;">
                        <i class="fas fa-paw" style="color:var(--brand);font-size:8px;"></i> {{ $rp->pet_name ?? $rp->pet_type }}
                    </div>
                    @endforeach
                    <button @click="openAddPetModal=true; showProfile=false; petPhotoPreview=null; vaccineProofPreview=null; petTypeSelection='';"
                            style="display:flex;align-items:center;gap:4px;background:#eff6ff;padding:4px 9px;border-radius:99px;border:1.5px dashed var(--brand);color:var(--brand);font-size:10px;font-weight:800;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.background='var(--brand)';this.style.color='#fff'" onmouseout="this.style.background='#eff6ff';this.style.color='var(--brand)'">
                        <i class="fas fa-plus" style="font-size:8px;"></i> Add Pet
                    </button>
                </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:9px;">
                <button class="btn-plain btn-edit" style="justify-content:center;"><i class="fas fa-print"></i> Print</button>
                <button @click="openEdit(selectedUser.id);showProfile=false" class="btn-grad" style="justify-content:center;"><i class="fas fa-edit"></i> Edit</button>
                <button type="button"
                        @click="archiveModal=true; archiveTarget={id:selectedUser.id,name:selectedUser.name}; showProfile=false"
                        class="btn-plain btn-amber" style="width:100%;justify-content:center;">
                    <i class="fas fa-archive"></i> Archive
                </button>
            </div>
        </div>
    </div>
</div>


{{-- ══ FAMILY MEMBERS MODAL ══ --}}
<div x-show="openFamilyModal" x-cloak class="modal-ov" x-transition style="z-index:600;">
    <div class="modal-box" style="max-width:520px;" @click.away="openFamilyModal=false">
        <div class="modal-in">
            <div class="modal-hd">
                <div class="modal-ttl">
                    <div class="modal-ttl-ico"><i class="fas fa-users"></i></div>
                    <div>
                        <div x-text="selectedHeadName"></div>
                        <div style="font-size:10px;font-weight:600;color:var(--muted);margin-top:2px;">Household Members</div>
                    </div>
                </div>
                <button @click="openFamilyModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
            </div>
            <div style="padding:16px 20px 20px;">
                <template x-if="selectedFamilyMembers.length === 0">
                    <div style="text-align:center;padding:30px 0;color:var(--muted);">
                        <i class="fas fa-user-friends" style="font-size:32px;color:#e2e8f0;margin-bottom:12px;display:block;"></i>
                        <div style="font-size:12px;font-weight:700;">No other family members found.</div>
                    </div>
                </template>
                <template x-for="m in selectedFamilyMembers" :key="m.id">
                    <div style="display:flex;align-items:center;gap:14px;padding:11px 14px;border-radius:12px;margin-bottom:8px;background:#f8fafc;border:1px solid var(--border);">
                        <img :src="m.photo||'https://ui-avatars.com/api/?name='+encodeURIComponent((m.first_name||'')+' '+(m.last_name||''))+'&background=0E5393&color=fff&bold=true&rounded=true'"
                             x-on:error="$el.src='https://ui-avatars.com/api/?name='+encodeURIComponent((m.first_name||'')+' '+(m.last_name||''))+'&background=0E5393&color=fff&bold=true&rounded=true'"
                             style="width:44px;height:44px;border-radius:10px;object-fit:cover;border:2px solid #fff;box-shadow:0 1px 6px rgba(0,0,0,.1);flex-shrink:0;">
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:13px;font-weight:800;color:#0f172a;" x-text="(m.first_name||'') + ' ' + (m.last_name||'')"></div>
                            <div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:1px;"
                                 x-text="(m.resident_code||m.code||'') + (m.relationship ? ' • ' + m.relationship : '')"></div>
                            <div style="font-size:10px;color:var(--light);font-weight:600;"
                                 x-text="m.birthday ? new Date(m.birthday).toLocaleDateString('en-PH',{year:'numeric',month:'long',day:'numeric'}) : ''"></div>
                        </div>
                        <div style="display:flex;gap:4px;flex-wrap:wrap;justify-content:flex-end;">
                            <span x-show="m.is_voter" class="pill pill-voter">Voter</span>
                            <span x-show="m.is_senior" class="pill pill-senior">Senior</span>
                            <span x-show="m.is_pwd" class="pill pill-pwd">PWD</span>
                            <span x-show="m.is_single_parent" class="pill pill-solo">Solo</span>
                            <span x-show="m.is_bedridden" class="pill pill-pwd" style="background:#fee2e2;color:#dc2626;">Bed-ridden</span>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

{{-- ══ ARCHIVE CONFIRMATION MODAL ══ --}}
<div x-show="archiveModal" x-cloak class="modal-ov" x-transition style="z-index:600;">
    <div class="modal-box" style="max-width:380px;" @click.away="archiveModal=false">
        <div class="modal-in">
            <div style="text-align:center;padding:10px 0 6px;">
                <div style="width:56px;height:56px;border-radius:50%;background:#fef3c7;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                    <i class="fas fa-archive" style="font-size:22px;color:#d97706;"></i>
                </div>
                <div style="font-size:15px;font-weight:900;color:#0f172a;margin-bottom:6px;">Archive Resident?</div>
                <p style="font-size:12px;color:#64748b;font-weight:600;margin-bottom:6px;">You are about to archive:</p>
                <p style="font-size:14px;font-weight:900;color:#0E5393;" x-text="archiveTarget.name"></p>
                <p style="font-size:11px;color:#94a3b8;font-weight:600;margin-top:8px;">They will be removed from the masterlist. You can restore them later.</p>
            </div>
            <div style="display:flex;gap:10px;margin-top:20px;">
                <button type="button" @click="archiveModal=false"
                        style="flex:1;padding:11px;border:1.5px solid #e2e8f0;background:#f8fafc;border-radius:9px;font-size:12px;font-weight:800;color:#64748b;cursor:pointer;transition:all .15s;"
                        onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f8fafc'">
                    Cancel
                </button>
                <form :action="'/office/'+archiveTarget.id+'/archive'" method="POST" style="flex:1;">
                    @csrf @method('PATCH')
                    <button type="submit"
                            style="width:100%;padding:11px;background:linear-gradient(135deg,#d97706 0%,#b45309 100%);border:none;border-radius:9px;font-size:12px;font-weight:800;color:#fff;cursor:pointer;transition:opacity .15s;box-shadow:0 2px 8px rgba(217,119,6,.35);"
                            onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                        <i class="fas fa-archive" style="margin-right:5px;"></i> Yes, Archive
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ══ PET ARCHIVE CONFIRMATION MODAL ══ --}}
<div x-show="archivePetModal" x-cloak class="modal-ov" x-transition style="z-index:700;">
    <div class="modal-box" style="max-width:380px;" @click.away="archivePetModal=false">
        <div class="modal-in">
            <div style="text-align:center;padding:10px 0 6px;">
                <div style="width:56px;height:56px;border-radius:50%;background:#fef2f2;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                    <i class="fas fa-paw" style="font-size:22px;color:#dc2626;"></i>
                </div>
                <div style="font-size:15px;font-weight:900;color:#0f172a;margin-bottom:6px;">Archive Pet Record?</div>
                <p style="font-size:12px;color:#64748b;font-weight:600;margin-bottom:6px;">You are about to archive:</p>
                <p style="font-size:14px;font-weight:900;color:var(--brand);" x-text="archivePetTarget.name"></p>
                <p style="font-size:11px;color:#94a3b8;font-weight:600;margin-top:8px;">This will remove the pet from the tracker.</p>
            </div>
            <div style="display:flex;gap:10px;margin-top:20px;">
                <button type="button" @click="archivePetModal=false"
                        style="flex:1;padding:11px;border:1.5px solid #e2e8f0;background:#f8fafc;border-radius:9px;font-size:12px;font-weight:800;color:#64748b;cursor:pointer;transition:all .15s;"
                        onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f8fafc'">
                    Cancel
                </button>
                <form :action="'/pets/'+archivePetTarget.id" method="POST" style="flex:1;">
                    @csrf @method('DELETE')
                    <button type="submit"
                            style="width:100%;padding:11px;background:linear-gradient(135deg,#dc2626 0%,#991b1b 100%);border:none;border-radius:9px;font-size:12px;font-weight:800;color:#fff;cursor:pointer;transition:opacity .15s;box-shadow:0 2px 8px rgba(220,38,38,.35);"
                            onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                        <i class="fas fa-archive" style="margin-right:5px;"></i> Yes, Archive
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ══ PET TRACKER MODAL ══ --}}
<div x-show="openPetTracker" x-cloak class="modal-ov" x-transition>
    <div class="modal-box" style="max-width:860px;" @click.away="openPetTracker=false">
        <div class="modal-in">
            <div class="modal-hd"><div class="modal-ttl"><div class="modal-ttl-ico"><i class="fas fa-paw"></i></div> Pet Tracker</div><button @click="openPetTracker=false" class="modal-close"><i class="fas fa-times-circle"></i></button></div>
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:11px;margin-bottom:18px;">
                <div style="background:#eff6ff;padding:14px;border-radius:11px;text-align:center;border:1px solid #bfdbfe;"><div style="font-size:30px;font-weight:900;color:var(--brand-dark);">{{ ($pets??collect())->count() }}</div><div style="font-size:9px;font-weight:800;color:var(--brand);text-transform:uppercase;margin-top:3px;">Total Pets</div></div>
                <div style="background:#f0fdf4;padding:14px;border-radius:11px;text-align:center;border:1px solid #bbf7d0;"><div style="font-size:30px;font-weight:900;color:#15803d;">{{ ($pets??collect())->where('vaccination_status','verified')->count() }}</div><div style="font-size:9px;font-weight:800;color:#16a34a;text-transform:uppercase;margin-top:3px;">Verified</div></div>
                <div style="background:#fef3c7;padding:14px;border-radius:11px;text-align:center;border:1px solid #fde68a;"><div style="font-size:30px;font-weight:900;color:#a16207;">{{ ($pets??collect())->where('vaccination_status','pending')->count() }}</div><div style="font-size:9px;font-weight:800;color:#d97706;text-transform:uppercase;margin-top:3px;">Pending</div></div>
                <div style="background:#fef2f2;padding:14px;border-radius:11px;text-align:center;border:1px solid #fecaca;"><div style="font-size:30px;font-weight:900;color:#dc2626;">{{ ($pets??collect())->where('vaccination_status','rejected')->count() }}</div><div style="font-size:9px;font-weight:800;color:#ef4444;text-transform:uppercase;margin-top:3px;">Rejected</div></div>
            </div>
            <div style="background:#f8fafc;border-radius:11px;overflow:hidden;border:1px solid var(--border);">
                <table class="pet-table">
                    <thead><tr><th>Owner</th><th>Pet Name</th><th>Type</th><th>Breed</th><th>Age</th><th>Qty</th><th>Vaccine Proof</th><th>Last Vacc.</th><th></th></tr></thead>
                    <tbody>
                        @forelse($pets??[] as $pet)
                        <tr id="pet-row-{{ $pet->id }}" x-data="{ openVerify: false, openReject: false, showProof: false, reason: '' }" style="transition: background-color 0.5s;">
                            <td style="font-weight:700;">{{ $pet->resident->first_name??'N/A' }} {{ $pet->resident->last_name??'' }}</td>
                            <td>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <img src="{{ $pet->pet_photo ? asset('storage/'.$pet->pet_photo) : 'https://ui-avatars.com/api/?name='.urlencode($pet->pet_name??'P').'&background=0E5393&color=fff&bold=true' }}" 
                                         style="width:30px;height:30px;border-radius:6px;object-fit:cover;border:1px solid #ddd;">
                                    <div style="font-weight:700;color:var(--brand);">{{ $pet->pet_name??'-' }}</div>
                                </div>
                            </td>
                            <td>{{ $pet->pet_type }}</td><td>{{ $pet->breed ?? '-' }}</td><td>{{ $pet->age ?? '-' }}</td><td>{{ $pet->quantity ?? 1 }}</td>
                            <td>
                                @if($pet->vaccination_status==='verified') 
                                    <span @if($pet->vaccine_proof) @click="showProof=true" style="cursor:pointer;" title="Click to view proof" @endif 
                                          class="pill" style="background:#dcfce7;color:#15803d;display:inline-flex;align-items:center;gap:3px;">
                                        <i class="fas fa-check-circle"></i> Vaccinated
                                    </span>

                                    {{-- Verified Proof Modal (View & Close Only) --}}
                                    @if($pet->vaccine_proof)
                                    <div x-show="showProof" x-cloak class="modal-ov" style="z-index:1000;" x-transition>
                                        <div class="modal-box" style="max-width:420px;" @click.away="showProof = false">
                                            <div class="modal-in">
                                                <div class="modal-hd" style="border-bottom:none;margin-bottom:10px;padding-bottom:0;">
                                                    <div class="modal-ttl">Pet Health Verification</div>
                                                    <button @click="showProof = false" class="modal-close"><i class="fas fa-times"></i></button>
                                                </div>
                                                <div style="margin-bottom:14px; text-align:left;">
                                                    <label class="flbl">Vaccination Card Proof:</label>
                                                    <div style="display:block;margin-top:5px;cursor:default;">
                                                        <img src="{{ asset('storage/'.$pet->vaccine_proof) }}" style="width:100%;max-height:320px;object-fit:contain;border:2px solid #ddd;border-radius:10px;">
                                                    </div>
                                                </div>
                                                <div style="display:flex;justify-content:flex-end;gap:8px;">
                                                    <button type="button" @click="showProof = false" class="btn-plain btn-edit">Close</button>
                                                    <a href="{{ asset('storage/'.$pet->vaccine_proof) }}" download class="btn-grad btn-sm" style="display:inline-flex;text-decoration:none;">
                                                        <i class="fas fa-download"></i> Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                @elseif($pet->vaccination_status==='pending')
                                    <span @click="openVerify=true" class="pill" style="background:#fef3c7;color:#a16207;cursor:pointer;display:inline-flex;align-items:center;gap:3px;" title="Click to Review Proof">
                                       <i class="fas fa-clock"></i> Pending Review
                                    </span>

                                    {{-- Pending Review Modal (with Approve / Reject actions) --}}
                                    <div x-show="openVerify" x-cloak class="modal-ov" style="z-index:500;">
                                        <div class="modal-box" style="max-width:440px;" @click.away="openVerify=false">
                                            <div class="modal-in">
                                                <div class="modal-hd" style="border-bottom:none;margin-bottom:10px;padding-bottom:0;">
                                                    <div class="modal-ttl">Pet Health Verification</div>
                                                    <button @click="openVerify=false" class="modal-close"><i class="fas fa-times"></i></button>
                                                </div>
                                                <div style="margin-bottom:14px; text-align:left;">
                                                    <label class="flbl">Vaccination Card Proof:</label>
                                                    @if($pet->vaccine_proof)
                                                        <div style="display:block;margin-top:5px;cursor:default;">
                                                            <img src="{{ asset('storage/'.$pet->vaccine_proof) }}" style="width:100%;max-height:320px;object-fit:contain;border:2px solid #ddd;border-radius:10px;">
                                                        </div>
                                                    @else
                                                        <p style="font-size:10px;color:var(--muted);padding:20px;background:#f8fafc;border-radius:8px;text-align:center;"><i class="fas fa-image" style="display:block;font-size:20px;margin-bottom:5px;opacity:.3;"></i> No proof uploaded.</p>
                                                    @endif
                                                </div>
                                                <div style="display:flex;justify-content:flex-end;align-items:center;gap:8px;flex-wrap:nowrap;">
                                                    <button type="button" @click="openVerify=false" class="btn-plain btn-edit" style="padding:8px 14px;font-size:10px;white-space:nowrap;">Cancel</button>
                                                    
                                                    {{-- Reject Dropdown Menu Button --}}
                                                    <div style="position:relative;display:inline-block;" x-data="{ openRejectMenu: false, customPrompt: false, reasonCustom: '' }" @click.away="openRejectMenu=false">
                                                        <button type="button" @click="openRejectMenu = !openRejectMenu" class="btn-plain btn-amber" style="background:#fee2e2;color:#dc2626;border:1px solid #fecaca;padding:8px 14px;font-size:10px;white-space:nowrap;display:inline-flex;align-items:center;gap:5px;cursor:pointer;">
                                                            <i class="fas fa-times"></i> Reject <i class="fas fa-chevron-down" style="font-size:8px;"></i>
                                                        </button>

                                                        <div x-show="openRejectMenu" x-cloak x-transition
                                                             style="position:absolute;bottom:calc(100% + 6px);right:0;width:240px;background:#fff;border-radius:10px;box-shadow:0 10px 25px rgba(0,0,0,0.18);border:1.5px solid var(--border);padding:6px;z-index:999;text-align:left;">
                                                            <div style="font-size:8px;font-weight:900;color:var(--muted);text-transform:uppercase;padding:4px 8px;margin-bottom:2px;letter-spacing:.05em;">Select Rejection Reason</div>
                                                            
                                                            <form action="{{ route('pets.status', $pet->id) }}" method="POST" style="margin:0;">
                                                                @csrf @method('PATCH')
                                                                <input type="hidden" name="vaccination_status" value="rejected">
                                                                <input type="hidden" name="rejection_reason" value="Blurry / Unclear Photo">
                                                                <button type="submit" style="width:100%;text-align:left;background:none;border:none;padding:7px 8px;font-size:10px;font-weight:700;color:#334155;border-radius:6px;cursor:pointer;display:flex;align-items:center;gap:6px;" onmouseover="this.style.background='#fee2e2';this.style.color='#dc2626'" onmouseout="this.style.background='none';this.style.color='#334155'">
                                                                    <i class="fas fa-camera" style="font-size:9px;opacity:0.6;"></i> Blurry / Unclear Photo
                                                                </button>
                                                            </form>

                                                            <form action="{{ route('pets.status', $pet->id) }}" method="POST" style="margin:0;">
                                                                @csrf @method('PATCH')
                                                                <input type="hidden" name="vaccination_status" value="rejected">
                                                                <input type="hidden" name="rejection_reason" value="Wrong Photo Submitted (Not a Vaccination Card)">
                                                                <button type="submit" style="width:100%;text-align:left;background:none;border:none;padding:7px 8px;font-size:10px;font-weight:700;color:#334155;border-radius:6px;cursor:pointer;display:flex;align-items:center;gap:6px;" onmouseover="this.style.background='#fee2e2';this.style.color='#dc2626'" onmouseout="this.style.background='none';this.style.color='#334155'">
                                                                    <i class="fas fa-file-excel" style="font-size:9px;opacity:0.6;"></i> Wrong Photo Submitted
                                                                </button>
                                                            </form>

                                                            <form action="{{ route('pets.status', $pet->id) }}" method="POST" style="margin:0;">
                                                                @csrf @method('PATCH')
                                                                <input type="hidden" name="vaccination_status" value="rejected">
                                                                <input type="hidden" name="rejection_reason" value="Expired / Outdated Vaccine Record">
                                                                <button type="submit" style="width:100%;text-align:left;background:none;border:none;padding:7px 8px;font-size:10px;font-weight:700;color:#334155;border-radius:6px;cursor:pointer;display:flex;align-items:center;gap:6px;" onmouseover="this.style.background='#fee2e2';this.style.color='#dc2626'" onmouseout="this.style.background='none';this.style.color='#334155'">
                                                                    <i class="fas fa-calendar-times" style="font-size:9px;opacity:0.6;"></i> Expired Vaccine Record
                                                                </button>
                                                            </form>

                                                            <form action="{{ route('pets.status', $pet->id) }}" method="POST" style="margin:0;">
                                                                @csrf @method('PATCH')
                                                                <input type="hidden" name="vaccination_status" value="rejected">
                                                                <input type="hidden" name="rejection_reason" value="Incomplete / Missing Pet Details or Signature">
                                                                <button type="submit" style="width:100%;text-align:left;background:none;border:none;padding:7px 8px;font-size:10px;font-weight:700;color:#334155;border-radius:6px;cursor:pointer;display:flex;align-items:center;gap:6px;" onmouseover="this.style.background='#fee2e2';this.style.color='#dc2626'" onmouseout="this.style.background='none';this.style.color='#334155'">
                                                                    <i class="fas fa-signature" style="font-size:9px;opacity:0.6;"></i> Incomplete Details
                                                                </button>
                                                            </form>

                                                            <div style="border-top:1px solid #f1f5f9;margin:4px 0;padding-top:4px;">
                                                                <div x-show="!customPrompt">
                                                                    <button type="button" @click="customPrompt = true" style="width:100%;text-align:left;background:none;border:none;padding:7px 8px;font-size:10px;font-weight:700;color:#64748b;border-radius:6px;cursor:pointer;display:flex;align-items:center;gap:6px;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='none'">
                                                                        <i class="fas fa-pen" style="font-size:9px;opacity:0.6;"></i> Others (Specify)...
                                                                    </button>
                                                                </div>
                                                                <form x-show="customPrompt" action="{{ route('pets.status', $pet->id) }}" method="POST" style="padding:4px;" @submit="if(!reasonCustom.trim()){ $event.preventDefault(); }">
                                                                    @csrf @method('PATCH')
                                                                    <input type="hidden" name="vaccination_status" value="rejected">
                                                                    <input type="text" name="rejection_reason" x-model="reasonCustom" placeholder="Type custom reason..." required class="finput" style="font-size:10px;padding:6px;margin-bottom:5px;">
                                                                    <div style="display:flex;justify-content:flex-end;gap:4px;">
                                                                        <button type="button" @click="customPrompt = false" class="btn-plain btn-edit" style="font-size:8px;padding:4px 7px;">Cancel</button>
                                                                        <button type="submit" class="btn-grad btn-sm" style="background:var(--danger);font-size:8px;padding:4px 9px;">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <form action="{{ route('office.pets.approve-vaccine', $pet->id) }}" method="POST" style="margin:0;display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn-grad btn-green" style="background:var(--success);padding:8px 14px;font-size:10px;white-space:nowrap;"><i class="fas fa-check"></i> Verify Proof</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @elseif($pet->vaccination_status==='rejected')
                                    <div style="display:flex; flex-direction:column; gap:4px;">
                                        <span @if($pet->vaccine_proof) @click="showProof=true" style="cursor:pointer;" title="Click to view submitted proof" @endif
                                              class="pill" style="background:#fee2e2;color:#dc2626;display:inline-flex;align-items:center;gap:3px;">
                                            <i class="fas fa-times-circle"></i> Rejected
                                        </span>
                                        @if($pet->rejection_reason)
                                            <div style="font-size:9px; color:#991b1b; font-weight:600; line-height:1.2; max-width:120px;">
                                                <i class="fas fa-comment-dots" style="opacity:.6;"></i> {{ $pet->rejection_reason }}
                                            </div>
                                        @endif
                                    </div>

                                    @if($pet->vaccine_proof)
                                    <div x-show="showProof" x-cloak class="modal-ov" style="z-index:1000;" x-transition>
                                        <div class="modal-box" style="max-width:420px;" @click.away="showProof = false">
                                            <div class="modal-in">
                                                <div class="modal-hd" style="border-bottom:none;margin-bottom:10px;padding-bottom:0;">
                                                    <div class="modal-ttl">Pet Health Verification</div>
                                                    <button @click="showProof = false" class="modal-close"><i class="fas fa-times"></i></button>
                                                </div>
                                                <div style="margin-bottom:14px; text-align:left;">
                                                    <label class="flbl">Vaccination Card Proof:</label>
                                                    <div style="display:block;margin-top:5px;cursor:default;">
                                                        <img src="{{ asset('storage/'.$pet->vaccine_proof) }}" style="width:100%;max-height:320px;object-fit:contain;border:2px solid #ddd;border-radius:10px;">
                                                    </div>
                                                    @if($pet->rejection_reason)
                                                    <div style="margin-top:8px;padding:8px;background:#fef2f2;border:1px solid #fecaca;border-radius:8px;font-size:10px;color:#991b1b;font-weight:700;">
                                                        <strong>Reason:</strong> {{ $pet->rejection_reason }}
                                                    </div>
                                                    @endif
                                                </div>
                                                <div style="display:flex;justify-content:flex-end;gap:8px;">
                                                    <button type="button" @click="showProof = false" class="btn-plain btn-edit">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                @else
                                    <span class="pill" style="background:#f1f5f9;color:#64748b;display:inline-flex;align-items:center;gap:3px;"><i class="fas fa-shield-virus"></i> Unvaccinated</span>
                                @endif
                            </td>
                            <td style="font-size:10px;">{{ $pet->last_vaccine_date ? \Carbon\Carbon::parse($pet->last_vaccine_date)->format('M d, Y') : '-' }}</td>
                            <td>
                                <button type="button" 
                                        @click="archivePetModal=true; archivePetTarget={id:{{ $pet->id }}, name:'{{ addslashes($pet->pet_name) }}'}" 
                                        class="tbl-btn" style="background:#fef3c7;color:#d97706;" 
                                        onmouseover="this.style.background='#fde68a'" onmouseout="this.style.background='#fef3c7'">
                                    <i class="fas fa-archive"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="9"><div class="empty-st"><i class="fas fa-paw"></i><p>No pets yet.</p></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div style="display:flex;justify-content:flex-end;margin-top:14px;">
                <button type="button" @click="openArchivedPetsModal=true; openPetTracker=false;" class="btn-plain btn-edit" style="margin-right:auto;background:#fff;border:1px solid #cbd5e1;color:#475569;font-weight:800;font-size:10px;">
                    <i class="fas fa-archive" style="color:#d97706;"></i> View Archived Pets ({{ ($archivedPets ?? collect())->count() }})
                </button>
                <button @click="openPetTracker=false" class="btn-plain btn-edit"><i class="fas fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div>

{{-- ══ ARCHIVED PETS MODAL ══ --}}
<div x-show="openArchivedPetsModal" x-cloak class="modal-ov" x-transition style="z-index:550;" x-data="{ searchArchivedPets: '', filterArchivedPetType: '', filterArchivedPetVaccine: '' }">
    <div class="modal-box" style="max-width:880px;" @click.away="openArchivedPetsModal=false">
        <div class="modal-in">
            <div class="modal-hd">
                <div class="modal-ttl">
                    <div class="modal-ttl-ico" style="background:#fef3c7;color:#d97706;"><i class="fas fa-archive"></i></div>
                    <div>
                        <div>Archived Pets</div>
                        <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;letter-spacing:0;">Records of archived and deactivated pets</div>
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:8px;">
                    <button type="button" @click="openArchivedPetsModal=false; openPetTracker=true;" class="btn-plain btn-edit" style="font-size:10px;padding:5px 10px;">
                        <i class="fas fa-list"></i> Active Pet Tracker
                    </button>
                    <button @click="openArchivedPetsModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>
            </div>

            {{-- Search and Dropdown Filter Bar for Archived Pets --}}
            <div style="padding:10px 14px;background:#f8fafc;border-radius:10px;border:1px solid var(--border);margin-top:10px;display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
                <div style="flex:1;min-width:180px;position:relative;">
                    <i class="fas fa-search" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:11px;"></i>
                    <input type="text" x-model="searchArchivedPets" placeholder="Search pet name, breed, or owner..."
                           style="width:100%;padding:6px 10px 6px 30px;background:#fff;border:1.5px solid var(--border);border-radius:8px;font-size:11px;font-weight:600;outline:none;">
                </div>
                <select x-model="filterArchivedPetType" class="finput fselect" style="width:auto;font-size:11px;padding:6px 10px;">
                    <option value="">All Pet Types</option>
                    <option value="Dog">Dogs</option>
                    <option value="Cat">Cats</option>
                    <option value="Bird">Birds</option>
                    <option value="Others">Others</option>
                </select>
                <select x-model="filterArchivedPetVaccine" class="finput fselect" style="width:auto;font-size:11px;padding:6px 10px;">
                    <option value="">All Vaccine Status</option>
                    <option value="verified">Vaccinated (Verified)</option>
                    <option value="pending">Pending Review</option>
                    <option value="rejected">Rejected</option>
                    <option value="unvaccinated">Unvaccinated</option>
                </select>
            </div>

            <div style="background:#f8fafc;border-radius:11px;overflow:hidden;border:1px solid var(--border);margin-top:10px;">
                <table class="pet-table">
                    <thead>
                        <tr>
                            <th>Owner</th>
                            <th>Pet Name</th>
                            <th>Type</th>
                            <th>Breed</th>
                            <th>Age</th>
                            <th>Qty</th>
                            <th>Vaccination Status</th>
                            <th>Archived Date</th>
                            <th style="text-align:right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($archivedPets ?? [] as $apet)
                        @php
                            $ownerName = trim(($apet->resident->first_name ?? '') . ' ' . ($apet->resident->last_name ?? ''));
                            $petSearchContent = strtolower(($apet->pet_name ?? '') . ' ' . ($apet->breed ?? '') . ' ' . $ownerName);
                        @endphp
                        <tr x-show="(!searchArchivedPets || '{{ $petSearchContent }}'.includes(searchArchivedPets.toLowerCase())) &&
                                    (!filterArchivedPetType || '{{ $apet->pet_type }}' === filterArchivedPetType) &&
                                    (!filterArchivedPetVaccine || '{{ $apet->vaccination_status }}' === filterArchivedPetVaccine)"
                            style="transition:all .15s;">
                            <td style="font-weight:700;">{{ $ownerName ?: 'N/A' }}</td>
                            <td>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <img src="{{ $apet->pet_photo ? asset('storage/'.$apet->pet_photo) : 'https://ui-avatars.com/api/?name='.urlencode($apet->pet_name??'P').'&background=64748B&color=fff&bold=true' }}" 
                                         style="width:30px;height:30px;border-radius:6px;object-fit:cover;border:1px solid #ddd;filter:grayscale(60%);">
                                    <div>
                                        <div style="font-weight:700;color:#475569;">{{ $apet->pet_name ?? '-' }}</div>
                                        <span class="pill" style="background:#fee2e2;color:#dc2626;font-size:8px;padding:1px 5px;">Archived</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $apet->pet_type }}</td>
                            <td>{{ $apet->breed ?? '-' }}</td>
                            <td>{{ $apet->age ?? '-' }}</td>
                            <td>{{ $apet->quantity ?? 1 }}</td>
                            <td>
                                @if($apet->vaccination_status === 'verified')
                                    <span class="pill" style="background:#dcfce7;color:#15803d;font-size:9px;"><i class="fas fa-check-circle"></i> Vaccinated</span>
                                @elseif($apet->vaccination_status === 'pending')
                                    <span class="pill" style="background:#fef3c7;color:#a16207;font-size:9px;"><i class="fas fa-clock"></i> Pending</span>
                                @elseif($apet->vaccination_status === 'rejected')
                                    <span class="pill" style="background:#fee2e2;color:#dc2626;font-size:9px;"><i class="fas fa-times-circle"></i> Rejected</span>
                                @else
                                    <span class="pill" style="background:#f1f5f9;color:#64748b;font-size:9px;">Unvaccinated</span>
                                @endif
                            </td>
                            <td style="font-size:10px;color:var(--muted);">{{ $apet->updated_at ? $apet->updated_at->format('M d, Y') : '-' }}</td>
                            <td style="text-align:right;">
                                <form action="{{ route('pets.restore', $apet->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn-plain btn-green" style="padding:4px 10px;font-size:10px;gap:4px;" title="Restore Pet to Active Tracker">
                                        <i class="fas fa-undo"></i> Restore
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-st" style="padding:30px 10px;">
                                    <i class="fas fa-archive" style="font-size:32px;color:#cbd5e1;"></i>
                                    <p style="font-size:12px;color:var(--muted);margin-top:6px;font-weight:700;">No archived pets found.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="display:flex;justify-content:flex-end;margin-top:14px;">
                <button type="button" @click="openArchivedPetsModal=false" class="btn-plain btn-edit"><i class="fas fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div>


{{-- ══ ADD PET MODAL ══ --}}
<div x-show="openAddPetModal" x-cloak class="modal-ov" x-transition>
    <div class="modal-box" style="max-width:500px;" @click.away="openAddPetModal=false">
        <div class="modal-in">
            <div class="modal-hd"><div class="modal-ttl"><div class="modal-ttl-ico"><i class="fas fa-paw"></i></div> Register Pet</div><button @click="openAddPetModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button></div>
            <form action="{{ url('/pets/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div x-data="{
                    petOwnerSearch:'', petOwnerSelectedId:null, petOwnerOpen:false,
                    residents: {{ $users->map(fn($u)=>['id'=>$u->id,'name'=>$u->first_name.' '.$u->last_name,'code'=>$u->resident_code??'NO-CODE'])->values()->toJson() }},
                    get filtered() { if(this.petOwnerSearch.length<1) return []; const q=this.petOwnerSearch.toLowerCase(); return this.residents.filter(r=>r.name.toLowerCase().includes(q)||r.code.toLowerCase().includes(q)).slice(0,8); },
                    select(r) { this.petOwnerSearch=r.name+' — '+r.code; this.petOwnerSelectedId=r.id; this.petOwnerOpen=false; },
                    init() { 
                        // Watch for modal opening to auto-select resident
                        this.$watch('$parent.openAddPetModal', (val) => {
                            if(val && this.$root.selectedUser && this.$root.selectedUser.id){
                                const f=this.residents.find(r=>r.id == this.$root.selectedUser.id);
                                if(f) this.select(f);
                            }
                        });
                        // Also watch for user selection changes while modal is open
                        this.$watch('$root.selectedUser',(val)=>{ 
                            if(val && val.id){ 
                                const f=this.residents.find(r=>r.id==val.id); 
                                if(f) this.select(f); 
                            } else { 
                                this.petOwnerSearch=''; 
                                this.petOwnerSelectedId=null; 
                            } 
                        }); 
                    }
                }">
                    <div class="fgrp">
                        <label class="flbl">Owner (Resident)</label>
                        <div style="position:relative;">
                            <div style="display:flex;align-items:center;background:#f8fafc;border:1.5px solid var(--border);border-radius:9px;padding:9px 13px;gap:7px;">
                                <i class="fas fa-search" style="color:var(--light);font-size:11px;"></i>
                                <input type="text" x-model="petOwnerSearch" @focus="petOwnerOpen=true" @input="petOwnerOpen=true; petOwnerSelectedId=null" @click.away="petOwnerOpen=false"
                                       placeholder="Type name or code..." autocomplete="off"
                                       style="flex:1;background:transparent;border:none;font-family:inherit;font-size:12px;font-weight:600;color:var(--text);outline:none;">
                                <span x-show="petOwnerSelectedId" class="pill pill-voter">Selected</span>
                                <button type="button" x-show="petOwnerSearch" @click="petOwnerSearch='';petOwnerSelectedId=null" style="background:none;border:none;color:var(--light);cursor:pointer;"><i class="fas fa-times" style="font-size:10px;"></i></button>
                            </div>
                            <div x-show="petOwnerOpen && filtered.length > 0" x-transition class="suggestions-box">
                                <template x-for="r in filtered" :key="r.id"><div @click="select(r)" class="sugg-item"><div><div class="sugg-name" x-text="r.name"></div><div class="sugg-meta" x-text="r.code"></div></div></div></template>
                            </div>
                            <input type="hidden" name="resident_id" :value="petOwnerSelectedId">
                        </div>
                    </div>

                    <div style="display:flex;gap:15px;margin-bottom:15px;align-items:flex-start;">
                        {{-- Pet Photo --}}
                        <div style="flex-shrink:0;" x-data="{ isDragging: false }">
                            <label class="flbl">Pet Photo (1x1)</label>
                            <label class="photo-up" style="width:100px;height:100px;border-radius:12px;"
                                   :style="isDragging ? 'border-color:var(--brand); background:#eff6ff;' : ''"
                                   @dragover.prevent="isDragging = true"
                                   @dragleave.prevent="isDragging = false"
                                   @drop.prevent="isDragging = false; if($event.dataTransfer.files[0]){ $refs.petPhotoInput.files = $event.dataTransfer.files; $refs.petPhotoInput.dispatchEvent(new Event('change')); }">
                                <template x-if="petPhotoPreview">
                                    <img :src="petPhotoPreview" style="width:100%;height:100%;object-fit:cover;">
                                </template>
                                <template x-if="!petPhotoPreview">
                                    <div style="text-align:center;">
                                        <i class="fas fa-camera" style="font-size:20px;color:var(--light);margin-bottom:4px;"></i>
                                        <div style="font-size:8px;font-weight:800;color:var(--light);text-transform:uppercase;">Click or Drag</div>
                                    </div>
                                </template>
                                <input type="file" name="pet_photo" x-ref="petPhotoInput" accept="image/*" style="display:none;" 
                                       @change="const f=$event.target.files[0]; if(f){ const r=new FileReader(); r.onload=e=>petPhotoPreview=e.target.result; r.readAsDataURL(f) }">
                            </label>
                        </div>
                        <div style="flex:1;">
                            <div class="fgrp"><label class="flbl">Pet Name</label><input type="text" name="pet_name" placeholder="e.g. Bantay, Muning..." class="finput" required></div>
                            <div class="fgrp"><label class="flbl">Breed</label><input type="text" name="breed" placeholder="e.g. Aspin, Puspin..." class="finput"></div>
                        </div>
                    </div>
                    <div class="fgrp">
                        <label class="flbl">Pet Type</label>
                        <style>
                            .pet-type-card { border:2px solid var(--border);border-radius:9px;padding:9px 5px;text-align:center;font-size:10px;font-weight:800;color:var(--muted);transition:all .12s;cursor:pointer; }
                            .pet-type-card:hover { border-color:var(--brand); background:#eff6ff; color:var(--brand); }
                            input[name="pet_type"]:checked + .pet-type-card { border-color:var(--brand) !important; background:var(--brand) !important; color:#fff !important; }
                        </style>
                        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:7px;margin-bottom:7px;">
                            @foreach(['Dog'=>'🐶','Cat'=>'🐱','Bird'=>'🐦','Rabbit'=>'🐰','Fish'=>'🐟','Others'=>'➕'] as $type=>$emoji)
                            <label style="cursor:pointer;"><input type="radio" name="pet_type" value="{{ $type }}" @change="petTypeSelection='{{ $type }}'" class="hidden" required>
                                <div class="pet-type-card">{{ $emoji }} {{ $type }}</div>
                            </label>
                            @endforeach
                        </div>
                        <div x-show="petTypeSelection==='Others'" x-transition><input type="text" name="pet_type_other" placeholder="Specify pet type..." class="finput"></div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:11px;margin-bottom:11px;">
                        <div><label class="flbl">Age (yrs)</label><input type="number" name="age" min="0" placeholder="e.g. 2" class="finput"></div>
                        <div><label class="flbl">Months</label><input type="number" name="months" min="0" max="11" class="finput"></div>
                        <div><label class="flbl">Qty</label><input type="number" name="quantity" min="1" value="1" class="finput"></div>
                    </div>

                    <div class="fgrp">
                        <label class="flbl">Vaccination Record</label>
                        <div style="display:flex; gap:10px; align-items:flex-start;">
                            <label class="photo-up" style="width:120px; height:50px; border-radius:8px; border-style:dashed; flex-shrink:0;"
                                   x-data="{ isDragging: false }"
                                   :style="isDragging ? 'border-color:var(--brand); background:#eff6ff;' : ''"
                                   @dragover.prevent="isDragging = true"
                                   @dragleave.prevent="isDragging = false"
                                   @drop.prevent="isDragging = false; if($event.dataTransfer.files[0]){ $refs.vaccineInput.files = $event.dataTransfer.files; $refs.vaccineInput.dispatchEvent(new Event('change')); }">
                                <template x-if="vaccineProofPreview">
                                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--success);color:#fff;font-size:9px;font-weight:900;">
                                        <i class="fas fa-check-circle" style="margin-right:4px;"></i> SELECTED
                                    </div>
                                </template>
                                <template x-if="!vaccineProofPreview">
                                    <div style="text-align:center;">
                                        <i class="fas fa-file-medical" style="font-size:12px;color:var(--light);margin-bottom:2px;"></i>
                                        <div style="font-size:7px;font-weight:800;color:var(--light);text-transform:uppercase;">Proof</div>
                                    </div>
                                </template>
                                <input type="file" name="vaccine_proof" x-ref="vaccineInput" accept="image/*,application/pdf" style="display:none;" 
                                       @change="const f=$event.target.files[0]; if(f){ const r=new FileReader(); r.onload=e=>vaccineProofPreview=e.target.result; r.readAsDataURL(f) }">
                            </label>
                            <div style="flex:1;">
                                <select name="vaccination_status" class="finput fselect">
                                    <option value="unvaccinated">Unvaccinated</option>
                                    <option value="vaccinated">Vaccinated (Verified)</option>
                                    <option value="pending">Awaiting Verification</option>
                                </select>
                            </div>
                        </div>
                        <p style="font-size:8px;color:var(--muted);margin-top:4px;font-weight:600;">* Uploading a proof will automatically set status to 'Pending' if not verified.</p>
                    </div>

                    <div class="fgrp"><label class="flbl">Last Vaccine Date</label><input type="date" name="last_vaccine_date" class="finput"></div>
                    <div style="display:flex;justify-content:flex-end;gap:9px;">
                        <button type="button" @click="openAddPetModal=false" class="btn-plain btn-edit">Cancel</button>
                        <button type="submit" class="btn-grad" :disabled="!petOwnerSelectedId" :style="!petOwnerSelectedId ? 'opacity:0.5;cursor:not-allowed;' : ''">
                            <i class="fas fa-paw"></i> Register Pet
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ══ IMPORT MODAL ══ --}}
<div x-show="openImportModal" x-cloak class="modal-ov" x-transition>
    <div class="modal-box" style="max-width:500px;" @click.away="openImportModal=false">
        <div class="modal-in">
            <div class="modal-hd">
                <div class="modal-ttl">
                    <div class="modal-ttl-ico"><i class="fas fa-file-import"></i></div> Import Masterlist
                </div>
                <button @click="openImportModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
            </div>
            <form action="{{ route('office.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="fgrp" x-data="{ isDragging: false, fileName: '' }">
                    <label class="flbl" style="display:block;margin-bottom:8px;">Upload Excel/CSV File *</label>
                    <div class="finput" style="padding:20px; text-align:center; cursor:pointer; border-style:dashed;"
                         :style="isDragging ? 'border-color:var(--brand); background:#eff6ff;' : ''"
                         @click="$refs.importInput.click()"
                         @dragover.prevent="isDragging = true"
                         @dragleave.prevent="isDragging = false"
                         @drop.prevent="isDragging = false; if($event.dataTransfer.files[0]){ $refs.importInput.files = $event.dataTransfer.files; fileName = $refs.importInput.files[0].name; }">
                        <i class="fas fa-file-excel" style="font-size:24px; color:var(--brand); margin-bottom:8px;"></i>
                        <div style="font-size:12px; font-weight:700;" x-text="fileName || 'Click or Drag Excel/CSV File Here'"></div>
                        <input type="file" name="file" x-ref="importInput" accept=".xlsx,.xls,.csv" required style="display:none;" @change="fileName = $event.target.files[0]?.name || ''">
                    </div>
                    <p style="font-size:10px;color:var(--light);margin-top:6px;"><i class="fas fa-info-circle"></i> Accepts .xlsx or .csv files up to 10MB.</p>
                </div>
                <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:20px;">
                    <button type="button" @click="openImportModal=false" class="btn-plain btn-edit">Cancel</button>
                    <button type="submit" class="btn-plain btn-green"><i class="fas fa-upload"></i> Upload & Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ══ ADD RESIDENT MODAL ══ --}}
<div x-show="openAddModal" x-cloak class="modal-ov" x-transition>
    <div class="modal-box" style="max-height:92vh;overflow-y:auto;" @click.away="openAddModal=false">
        <div class="modal-in">
            <div class="modal-hd" style="position:sticky;top:0;background:#fff;z-index:10;padding-bottom:14px;margin-bottom:0;">
                <div class="modal-ttl"><div class="modal-ttl-ico"><i class="fas fa-user-plus"></i></div> Add New Resident</div>
                <button @click="openAddModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
            </div>
            <form action="{{ route('office.store') }}" method="POST" enctype="multipart/form-data" style="padding-top:14px;" 
                  x-data="{ isHouseholdHead: false, householdId: '', familyMembers: [] }"
                  x-init="$watch('isHouseholdHead', val => { if(val && !householdId) householdId = getNextHouseholdId() })">
                @csrf
                <div style="display:flex;justify-content:center;margin-bottom:18px;" x-data="{ isDragging: false }">
                    <label style="cursor:pointer;">
                        <div class="photo-up" style="position:relative;"
                             :style="isDragging ? 'border-color:var(--brand); background:#eff6ff;' : ''"
                             @dragover.prevent="isDragging = true"
                             @dragleave.prevent="isDragging = false"
                             @drop.prevent="isDragging = false; if($event.dataTransfer.files[0]){ $refs.addPhotoInput.files = $event.dataTransfer.files; $refs.addPhotoInput.dispatchEvent(new Event('change')); }">
                            <img x-show="photoPreview" :src="photoPreview" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:11px;">
                            <div x-show="!photoPreview" style="text-align:center;position:relative;z-index:1;"><i class="fas fa-camera" style="font-size:20px;color:var(--light);display:block;margin-bottom:3px;"></i><span style="font-size:8px;font-weight:700;color:var(--light);text-transform:uppercase;">Click or Drag</span></div>
                        </div>
                        <input type="file" name="photo" x-ref="addPhotoInput" accept="image/*" style="display:none;" @change="const f=$event.target.files[0];if(f){const reader=new FileReader();reader.onload=function(ev){photoPreview=ev.target.result;};reader.readAsDataURL(f);}">
                    </label>
                </div>
                <div style="display:grid;grid-template-columns:2fr 1fr 2fr 1fr;gap:11px;margin-bottom:12px;">
                    <div><label class="flbl">First Name *</label><input type="text" name="first_name" required class="finput"></div>
                    <div><label class="flbl">Middle Name</label><input type="text" name="middle_name" class="finput"></div>
                    <div><label class="flbl">Last Name *</label><input type="text" name="last_name" required class="finput"></div>
                    <div><label class="flbl">Suffix</label><input type="text" name="suffix" placeholder="e.g. Jr" class="finput"></div>
                </div>
                <div class="fgrid2 fgrp" x-data="{ addCivilStatus: '' }">
                    <div><label class="flbl">Birthday & Age *</label><div style="display:flex;gap:7px;"><input type="date" name="birthday" id="add-main-birthday" required class="finput" style="flex:1;" oninput="let bd=new Date(this.value);let t=new Date();let a=t.getFullYear()-bd.getFullYear();let m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;document.getElementById('add-main-age').value=a;" onchange="let bd=new Date(this.value);let t=new Date();let a=t.getFullYear()-bd.getFullYear();let m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;document.getElementById('add-main-age').value=a;"><input type="number" name="age" id="add-main-age" required placeholder="Age" class="finput" style="width:70px;"></div></div>
                    <div><label class="flbl">Birthplace *</label><input type="text" name="birthplace" required placeholder="City/Municipality" class="finput"></div>
                    <div><label class="flbl">Gender *</label><select name="gender" required class="finput fselect"><option value="">Select Gender *</option><option>Male</option><option>Female</option><option>Other</option></select></div>
                    <div><label class="flbl">Civil Status *</label><select name="civil_status" x-model="addCivilStatus" required class="finput fselect"><option value="">Select</option><option>Single</option><option>Married</option><option>Widowed</option><option>Separated</option></select></div>
                    <div x-show="addCivilStatus === 'Married'" x-transition class="fspan2"><label class="flbl">Spouse / Husband Name</label><input type="text" name="spouse_name" placeholder="Full name of spouse/husband..." class="finput"></div>
                    <div><label class="flbl">Contact No. *</label><input type="text" name="contact_number" required placeholder="09XXXXXXXXX" pattern="\d{11}" maxlength="11" minlength="11" title="Please enter exactly 11 digits (e.g. 09123456789)" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="finput"></div>
                    <div>
                        <label class="flbl">Occupation</label>
                        <input type="text" name="occupation" :disabled="occupationStatus==='unemployed'" :placeholder="occupationStatus==='unemployed'?'Unemployed':'Enter occupation'" class="finput">
                        <div style="display:flex;gap:10px;margin-top:5px;">
                            @foreach(['employed'=>'Employed','unemployed'=>'Unemployed','student'=>'Student'] as $v=>$l)
                            <label style="display:flex;align-items:center;gap:4px;cursor:pointer;font-size:9px;font-weight:700;color:var(--muted);"><input type="radio" x-model="occupationStatus" value="{{ $v }}" style="accent-color:var(--brand);"> {{ $l }}</label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="fgrp"><label class="flbl">Address *</label><input type="text" name="address" required placeholder="House No., Street, Purok, Barangay San Miguel II" class="finput"></div>
                <div class="fgrp">
                    <label class="flbl">Classifications</label>
                    <div class="classif-grid">
                        @foreach(['is_voter'=>'Voter','is_non_voter'=>'Non Voter','is_senior'=>'Senior Citizen','is_pwd'=>'PWD','is_single_parent'=>'Solo Parent','is_student'=>'Student','is_bedridden'=>'Bed-ridden'] as $field=>$label)
                        <label class="classif-lbl"><input type="checkbox" name="{{ $field }}" value="1"><span class="classif-txt">{{ $label }}</span></label>
                        @endforeach
                    </div>
                </div>
                <div class="fgrp" x-data="{ otherMembership: false }">
                    <label class="flbl">Memberships</label>
                    <div class="classif-grid" style="margin-bottom:7px;">
                        <label class="classif-lbl"><input type="checkbox" name="memberships[]" value="4Ps"><span class="classif-txt">4Ps</span></label>
                        <label class="classif-lbl"><input type="checkbox" name="memberships[]" value="KDBM"><span class="classif-txt">KDBM</span></label>
                        <label class="classif-lbl"><input type="checkbox" @change="otherMembership = $el.checked"><span class="classif-txt">Others</span></label>
                    </div>
                    <div x-show="otherMembership" x-transition>
                        <input type="text" name="memberships[]" placeholder="Specify other membership..." class="finput">
                    </div>
                </div>
                <div class="fgrp">
                    <div x-show="isHouseholdHead" x-transition class="fgrp">
                        <label class="flbl">Household ID</label>
                        <input type="text" name="household_id" x-model="householdId" placeholder="e.g. HH-12345" class="finput">
                    </div>
                    <label class="classif-lbl" style="display:inline-flex;margin-bottom:12px;">
                        <input type="checkbox" name="is_household_head" value="1" x-model="isHouseholdHead"><span class="classif-txt">Is Household Head</span>
                    </label>

                    <div x-show="isHouseholdHead" x-transition style="margin-top:12px;background:#f8fafc;padding:14px;border-radius:11px;border:1px solid var(--border);overflow-x:auto;">
                        <div style="font-size:10px;font-weight:900;color:var(--brand-dark);margin-bottom:9px;text-transform:uppercase;"><i class="fas fa-users"></i> Family Members</div>
                        <template x-for="(fm, idx) in familyMembers" :key="idx">
                            <div style="display:flex;min-width:max-content;gap:7px;margin-bottom:7px;align-items:end;">
                                <div style="width:110px;"><label class="flbl" style="font-size:8px;">First Name</label><input type="text" :name="'family_members['+idx+'][first_name]'" x-model="fm.first_name" required class="finput" style="padding:7px;font-size:11px;"></div>
                                <div style="width:80px;"><label class="flbl" style="font-size:8px;">Middle</label><input type="text" :name="'family_members['+idx+'][middle_name]'" x-model="fm.middle_name" class="finput" style="padding:7px;font-size:11px;"></div>
                                <div style="width:110px;"><label class="flbl" style="font-size:8px;">Last Name</label><input type="text" :name="'family_members['+idx+'][last_name]'" x-model="fm.last_name" required class="finput" style="padding:7px;font-size:11px;"></div>
                                <div style="width:50px;"><label class="flbl" style="font-size:8px;">Suffix</label><input type="text" :name="'family_members['+idx+'][suffix]'" x-model="fm.suffix" class="finput" style="padding:7px;font-size:11px;"></div>
                                <div style="width:90px;"><label class="flbl" style="font-size:8px;">Rel.</label><select :name="'family_members['+idx+'][relationship]'" x-model="fm.relationship" required class="finput fselect" style="padding:7px;font-size:11px;"><option value="">Select</option><option value="Wife">Wife</option><option value="Husband">Husband</option><option value="Father">Father</option><option value="Mother">Mother</option><option value="Sibling">Sibling</option><option value="Grandma">Grandma</option><option value="Grandpa">Grandpa</option></select></div>
                                <div style="width:110px;"><label class="flbl" style="font-size:8px;">Birthday</label><input type="date" :name="'family_members['+idx+'][birthday]'" x-model="fm.birthday" required @input="if(fm.birthday){const bd=new Date(fm.birthday);const t=new Date();let a=t.getFullYear()-bd.getFullYear();const m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;fm.age=a;}" @change="if(fm.birthday){const bd=new Date(fm.birthday);const t=new Date();let a=t.getFullYear()-bd.getFullYear();const m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;fm.age=a;}" class="finput" style="padding:6px;font-size:11px;"></div>
                                <div style="width:50px;"><label class="flbl" style="font-size:8px;">Age</label><input type="number" :name="'family_members['+idx+'][age]'" x-model="fm.age" required class="finput" style="padding:7px;font-size:11px;"></div>
                                <div style="width:70px;"><label class="flbl" style="font-size:8px;">Gender</label><select :name="'family_members['+idx+'][gender]'" x-model="fm.gender" required class="finput fselect" style="padding:7px;font-size:11px;"><option value="Male">Male</option><option value="Female">Female</option></select></div>
                                <div style="width:80px;"><label class="flbl" style="font-size:8px;">Status</label><select :name="'family_members['+idx+'][civil_status]'" x-model="fm.civil_status" required class="finput fselect" style="padding:7px;font-size:11px;"><option value="Single">Single</option><option value="Married">Married</option><option value="Widowed">Widowed</option><option value="Separated">Separated</option></select></div>
                                <div style="width:75px;"><label class="flbl" style="font-size:8px;">Voter?</label><select :name="'family_members['+idx+'][is_voter]'" x-model="fm.is_voter" class="finput fselect" style="padding:7px;font-size:11px;"><option value="0">No</option><option value="1">Yes</option></select></div>
                                <div style="width:100px;"><label class="flbl" style="font-size:8px;">Classification</label><select :name="'family_members['+idx+'][classification]'" x-model="fm.classification" class="finput fselect" style="padding:7px;font-size:11px;"><option value="">None</option><option value="PWD">PWD</option><option value="Senior">Senior</option><option value="Solo Parent">Solo Parent</option><option value="Student">Student</option><option value="Bed-ridden">Bed-ridden</option></select></div>
                                <button type="button" @click="familyMembers.splice(idx,1)" class="btn-plain btn-edit" style="width:34px;height:34px;padding:0;justify-content:center;margin-bottom:2px;"><i class="fas fa-trash" style="color:var(--danger);"></i></button>
                            </div>
                        </template>
                        <button type="button" @click="familyMembers.push({first_name:'',middle_name:'',last_name:'',suffix:'',relationship:'',birthday:'',age:'',gender:'Male',civil_status:'Single',is_voter:'0',classification:''})" class="btn-plain btn-edit" style="font-size:9px;margin-top:6px;"><i class="fas fa-plus"></i> Add Family Member</button>
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;gap:9px;padding-top:4px;">
                    <button type="button" @click="openAddModal=false" class="btn-plain btn-edit">Cancel</button>
                    <button type="submit" class="btn-grad"><i class="fas fa-user-plus"></i> Save Resident</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ══ EDIT RESIDENT MODAL ══ --}}
<div x-show="openEditModal" x-cloak class="modal-ov" x-transition>
    <div class="modal-box" @click.away="openEditModal=false">
        <div class="modal-in">
            <div class="modal-hd"><div class="modal-ttl"><div class="modal-ttl-ico"><i class="fas fa-user-edit"></i></div> Edit Resident</div><button @click="openEditModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button></div>
            <form :action="'/office/'+editUser.id" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div style="display:flex;justify-content:center;margin-bottom:18px;" x-data="{ isDragging: false }">
                    <label style="cursor:pointer;">
                        <div class="photo-up" style="position:relative;"
                             :style="isDragging ? 'border-color:var(--brand); background:#eff6ff;' : ''"
                             @dragover.prevent="isDragging = true"
                             @dragleave.prevent="isDragging = false"
                             @drop.prevent="isDragging = false; if($event.dataTransfer.files[0]){ $refs.editPhotoInput.files = $event.dataTransfer.files; $refs.editPhotoInput.dispatchEvent(new Event('change')); }">
                            <img x-show="editPhotoPreview" :src="editPhotoPreview" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:11px;">
                            <div x-show="!editPhotoPreview" style="text-align:center;position:relative;z-index:1;"><i class="fas fa-camera" style="font-size:20px;color:var(--light);display:block;margin-bottom:3px;"></i><span style="font-size:8px;font-weight:700;color:var(--light);text-transform:uppercase;">Click or Drag</span></div>
                        </div>
                        <input type="file" name="photo" x-ref="editPhotoInput" accept="image/*" style="display:none;" @change="const f=$event.target.files[0];if(f){const reader=new FileReader();reader.onload=function(ev){editPhotoPreview=ev.target.result;};reader.readAsDataURL(f);}">
                    </label>
                </div>
                <div style="display:grid;grid-template-columns:2fr 1fr 2fr 1fr;gap:11px;margin-bottom:12px;">
                    <div><label class="flbl">First Name *</label><input type="text" name="first_name" :value="editUser.first_name" required class="finput"></div>
                    <div><label class="flbl">Middle Name</label><input type="text" name="middle_name" :value="editUser.middle_name" class="finput"></div>
                    <div><label class="flbl">Last Name *</label><input type="text" name="last_name" :value="editUser.last_name" required class="finput"></div>
                    <div><label class="flbl">Suffix</label><input type="text" name="suffix" :value="editUser.suffix" placeholder="e.g. Jr" class="finput"></div>
                </div>
                <div class="fgrid2 fgrp" x-data="{ editCivilStatus: '' }" x-init="$watch('editUser', val => { editCivilStatus = val.civil_status || '' }); editCivilStatus = editUser.civil_status || ''">
                    <div><label class="flbl">Birthday & Age</label><div style="display:flex;gap:7px;"><input type="date" name="birthday" :value="editUser.birthday" class="finput" style="flex:1;" id="edit-main-birthday" oninput="let bd=new Date(this.value);let t=new Date();let a=t.getFullYear()-bd.getFullYear();let m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;document.getElementById('edit-main-age').value=a;" onchange="let bd=new Date(this.value);let t=new Date();let a=t.getFullYear()-bd.getFullYear();let m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;document.getElementById('edit-main-age').value=a;"><input type="number" name="age" :value="editUser.age" id="edit-main-age" placeholder="Age" class="finput" style="width:70px;"></div></div>
                    <div><label class="flbl">Birthplace</label><input type="text" name="birthplace" :value="editUser.birthplace" class="finput"></div>
                    <div><label class="flbl">Gender</label><select name="gender" class="finput fselect"><option value="">Select</option><template x-for="g in ['Male','Female','Other']"><option :value="g" :selected="editUser.gender===g" x-text="g"></option></template></select></div>
                    <div><label class="flbl">Civil Status</label><select name="civil_status" x-model="editCivilStatus" class="finput fselect"><option value="">Select</option><template x-for="s in ['Single','Married','Widowed','Separated']"><option :value="s" :selected="editCivilStatus===s" x-text="s"></option></template></select></div>
                    <div x-show="editCivilStatus === 'Married'" x-transition class="fspan2"><label class="flbl">Spouse / Husband Name</label><input type="text" name="spouse_name" :value="editUser.spouse_name||''" placeholder="Full name of spouse/husband..." class="finput"></div>
                    <div><label class="flbl">Contact No.</label><input type="text" name="contact_number" :value="editUser.contact_number" class="finput"></div>
                    <div><label class="flbl">Occupation</label><input type="text" name="occupation" :value="editUser.occupation" class="finput"></div>
                </div>
                <div class="fgrp"><label class="flbl">Address</label><input type="text" name="address" :value="editUser.address" class="finput"></div>
                <div class="fgrp">
                    <label class="flbl">Classifications</label>
                    <div class="classif-grid">
                        @foreach(['is_voter'=>'Voter','is_non_voter'=>'Non Voter','is_senior'=>'Senior Citizen','is_pwd'=>'PWD','is_single_parent'=>'Solo Parent','is_student'=>'Student','is_bedridden'=>'Bed-ridden'] as $field=>$label)
                        <label class="classif-lbl"><input type="checkbox" name="{{ $field }}" value="1" :checked="editUser.{{ $field }}"><span class="classif-txt">{{ $label }}</span></label>
                        @endforeach
                    </div>
                </div>
                <div class="fgrp" x-data="{ isHead: false, householdId: '', familyMembers: [] }" 
                     x-init="$watch('editUser', val => { isHead = val.is_household_head || false; householdId = val.household_id || ''; familyMembers = []; }); 
                             $watch('isHead', val => { if(val && !householdId) householdId = getNextHouseholdId() });
                             isHead = editUser.is_household_head || false; householdId = editUser.household_id || '';">
                    <div x-show="isHead" x-transition class="fgrp">
                        <label class="flbl">Household ID</label>
                        <input type="text" name="household_id" x-model="householdId" placeholder="e.g. HH-12345" class="finput">
                    </div>
                    <label class="classif-lbl" style="display:inline-flex;margin-bottom:12px;">
                        <input type="checkbox" name="is_household_head" value="1" x-model="isHead" :checked="isHead"><span class="classif-txt">Is Household Head</span>
                    </label>

                    <div x-show="isHead" x-transition style="margin-top:12px;background:#f8fafc;padding:14px;border-radius:11px;border:1px solid var(--border);overflow-x:auto;">
                        <div style="font-size:10px;font-weight:900;color:var(--brand-dark);margin-bottom:9px;text-transform:uppercase;"><i class="fas fa-users"></i> Add New Family Members</div>
                        <template x-for="(fm, idx) in familyMembers" :key="idx">
                            <div style="display:flex;min-width:max-content;gap:7px;margin-bottom:7px;align-items:end;">
                                <div style="width:110px;"><label class="flbl" style="font-size:8px;">First Name</label><input type="text" :name="'family_members['+idx+'][first_name]'" x-model="fm.first_name" required class="finput" style="padding:7px;font-size:11px;"></div>
                                <div style="width:80px;"><label class="flbl" style="font-size:8px;">Middle</label><input type="text" :name="'family_members['+idx+'][middle_name]'" x-model="fm.middle_name" class="finput" style="padding:7px;font-size:11px;"></div>
                                <div style="width:110px;"><label class="flbl" style="font-size:8px;">Last Name</label><input type="text" :name="'family_members['+idx+'][last_name]'" x-model="fm.last_name" required class="finput" style="padding:7px;font-size:11px;"></div>
                                <div style="width:50px;"><label class="flbl" style="font-size:8px;">Suffix</label><input type="text" :name="'family_members['+idx+'][suffix]'" x-model="fm.suffix" class="finput" style="padding:7px;font-size:11px;"></div>
                                <div style="width:90px;"><label class="flbl" style="font-size:8px;">Rel.</label><select :name="'family_members['+idx+'][relationship]'" x-model="fm.relationship" required class="finput fselect" style="padding:7px;font-size:11px;"><option value="">Select</option><option value="Wife">Wife</option><option value="Husband">Husband</option><option value="Father">Father</option><option value="Mother">Mother</option><option value="Sibling">Sibling</option><option value="Grandma">Grandma</option><option value="Grandpa">Grandpa</option><option value="Son">Son</option><option value="Daughter">Daughter</option></select></div>
                                <div style="width:110px;"><label class="flbl" style="font-size:8px;">Birthday</label><input type="date" :name="'family_members['+idx+'][birthday]'" x-model="fm.birthday" required @input="if(fm.birthday){const bd=new Date(fm.birthday);const t=new Date();let a=t.getFullYear()-bd.getFullYear();const m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;fm.age=a;}" @change="if(fm.birthday){const bd=new Date(fm.birthday);const t=new Date();let a=t.getFullYear()-bd.getFullYear();const m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;fm.age=a;}" class="finput" style="padding:6px;font-size:11px;"></div>
                                <div style="width:50px;"><label class="flbl" style="font-size:8px;">Age</label><input type="number" :name="'family_members['+idx+'][age]'" x-model="fm.age" required class="finput" style="padding:7px;font-size:11px;"></div>
                                <div style="width:70px;"><label class="flbl" style="font-size:8px;">Gender</label><select :name="'family_members['+idx+'][gender]'" x-model="fm.gender" required class="finput fselect" style="padding:7px;font-size:11px;"><option value="Male">Male</option><option value="Female">Female</option></select></div>
                                <div style="width:80px;"><label class="flbl" style="font-size:8px;">Status</label><select :name="'family_members['+idx+'][civil_status]'" x-model="fm.civil_status" required class="finput fselect" style="padding:7px;font-size:11px;"><option value="Single">Single</option><option value="Married">Married</option><option value="Widowed">Widowed</option><option value="Separated">Separated</option></select></div>
                                <div style="width:75px;"><label class="flbl" style="font-size:8px;">Voter?</label><select :name="'family_members['+idx+'][is_voter]'" x-model="fm.is_voter" class="finput fselect" style="padding:7px;font-size:11px;"><option value="0">No</option><option value="1">Yes</option></select></div>
                                <div style="width:100px;"><label class="flbl" style="font-size:8px;">Classification</label><select :name="'family_members['+idx+'][classification]'" x-model="fm.classification" class="finput fselect" style="padding:7px;font-size:11px;"><option value="">None</option><option value="PWD">PWD</option><option value="Senior">Senior</option><option value="Solo Parent">Solo Parent</option><option value="Student">Student</option><option value="Bed-ridden">Bed-ridden</option></select></div>
                                <button type="button" @click="familyMembers.splice(idx,1)" class="btn-plain btn-edit" style="width:34px;height:34px;padding:0;justify-content:center;margin-bottom:2px;"><i class="fas fa-trash" style="color:var(--danger);"></i></button>
                            </div>
                        </template>
                        <button type="button" @click="familyMembers.push({first_name:'',middle_name:'',last_name:'',suffix:'',relationship:'',birthday:'',age:'',gender:'Male',civil_status:'Single',is_voter:'0',classification:''})" class="btn-plain btn-edit" style="font-size:9px;margin-top:6px;"><i class="fas fa-plus"></i> Add Family Member</button>
                    </div>
                </div>
                <div class="fgrp" x-data="{
                    is4ps: false,
                    isKdbm: false,
                    otherValue: '',
                    otherMembership: false
                }"
                x-init="$watch('editUser', val => {
                    let m = val.memberships || [];
                    if(typeof m === 'string') { try { m = JSON.parse(m) || []; } catch(e){ m = []; } }
                    is4ps = m.includes('4Ps');
                    isKdbm = m.includes('KDBM');
                    let others = m.filter(x => x !== '4Ps' && x !== 'KDBM' && x !== '' && x !== null);
                    if(others.length > 0) {
                        otherMembership = true;
                        otherValue = others[0];
                    } else {
                        otherMembership = false;
                        otherValue = '';
                    }
                })">
                    <label class="flbl">Memberships</label>
                    <div class="classif-grid" style="margin-bottom:7px;">
                        <label class="classif-lbl"><input type="checkbox" name="memberships[]" value="4Ps" x-model="is4ps"><span class="classif-txt">4Ps</span></label>
                        <label class="classif-lbl"><input type="checkbox" name="memberships[]" value="KDBM" x-model="isKdbm"><span class="classif-txt">KDBM</span></label>
                        <label class="classif-lbl"><input type="checkbox" x-model="otherMembership"><span class="classif-txt">Others</span></label>
                    </div>
                    <div x-show="otherMembership" x-transition>
                        <input type="text" name="memberships[]" x-model="otherValue" placeholder="Specify other membership..." class="finput">
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;gap:9px;">
                    <button type="button" @click="openEditModal=false" class="btn-plain btn-edit">Cancel</button>
                    <button type="submit" class="btn-grad"><i class="fas fa-save"></i> Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ══ DIGITAL ID MODAL ══ --}}
<div x-show="openDigitalId" x-cloak x-transition class="modal-ov" style="z-index:150;">
    <div class="modal-box" style="max-width:620px;" @click.away="openDigitalId=false">
        <div class="modal-in">
            <div class="modal-hd">
                <div class="modal-ttl"><div class="modal-ttl-ico"><i class="fas fa-id-badge"></i></div><div><div>Digital ID Generator</div><div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;letter-spacing:0;">Barangay San Miguel II • Residence ID Card</div></div></div>
                <button @click="openDigitalId=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
            </div>

            {{-- Resident Search & Selection Bar --}}
            <div class="section-blk">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                    <div class="section-blk-ttl" style="margin-bottom:0;"><i class="fas fa-search"></i> Select Resident</div>
                    <template x-if="digitalIdResident">
                        <button type="button" @click="digitalIdResident=null; digitalIdSearch=''" class="btn-plain btn-edit" style="font-size:9px;padding:3px 8px;">
                            <i class="fas fa-user-friends"></i> Change Resident
                        </button>
                    </template>
                </div>
                <div style="position:relative;">
                    <div style="display:flex;align-items:center;background:#fff;border:1.5px solid var(--border);border-radius:9px;padding:9px 13px;gap:7px;">
                        <i class="fas fa-search" style="color:var(--light);font-size:11px;"></i>
                        <input type="text" x-model="digitalIdSearch"
                               placeholder="Search resident name or code..." autocomplete="off"
                               style="flex:1;background:transparent;border:none;font-family:inherit;font-size:12px;font-weight:600;color:var(--text);outline:none;">
                        <button type="button" x-show="digitalIdSearch" @click="digitalIdSearch=''; if(!digitalIdResident) digitalIdSearch=''" style="background:none;border:none;color:var(--light);cursor:pointer;font-size:10px;"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            </div>

            {{-- 1. SCROLLABLE RESIDENTS LIST (Shown when no resident is currently selected) --}}
            <div x-show="!digitalIdResident" style="margin-top:12px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;padding:0 2px;">
                    <div style="font-size:10px;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;">
                        All Residents (<span x-text="digitalIdSuggestions.length"></span>)
                    </div>
                    <div style="font-size:9px;color:var(--light);font-weight:600;">Click any resident below to view or generate ID</div>
                </div>
                <div style="max-height:330px;overflow-y:auto;border:1.5px solid var(--border);border-radius:12px;background:#f8fafc;padding:8px;">
                    <template x-for="r in digitalIdSuggestions" :key="r.id">
                        <div @click="selectDigitalIdResident(r)" 
                             style="display:flex;align-items:center;gap:12px;padding:10px 12px;border-radius:10px;background:#fff;margin-bottom:6px;cursor:pointer;border:1px solid #e2e8f0;transition:all .15s;"
                             onmouseover="this.style.borderColor='var(--brand)';this.style.background='#eff6ff';this.style.transform='translateY(-1px)'"
                             onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#fff';this.style.transform='translateY(0)'">
                            <img :src="r.photo || 'https://ui-avatars.com/api/?name='+encodeURIComponent(r.name)+'&background=0E5393&color=fff&bold=true&rounded=true'"
                                 x-on:error="$el.src='https://ui-avatars.com/api/?name='+encodeURIComponent(r.name)+'&background=0E5393&color=fff&bold=true&rounded=true'"
                                 style="width:38px;height:38px;border-radius:10px;object-fit:cover;border:1.5px solid #cbd5e1;flex-shrink:0;">
                            <div style="flex:1;min-width:0;">
                                <div style="font-size:12px;font-weight:900;color:var(--text);" x-text="r.name"></div>
                                <div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:1px;" x-text="(r.resident_code || r.code || 'NO-CODE') + ' • ' + (r.address || 'Barangay San Miguel II')"></div>
                            </div>
                            <div style="display:flex;align-items:center;gap:6px;">
                                <span x-show="r.digital_id_generated" class="pill" style="background:#dcfce7;color:#15803d;font-size:8.5px;padding:2px 7px;font-weight:800;">
                                    <i class="fas fa-check-circle"></i> Has ID
                                </span>
                                <span class="btn-outline" style="font-size:9.5px;padding:4px 10px;border-radius:7px;border:1.5px solid var(--brand);color:var(--brand);background:#fff;font-weight:800;display:inline-flex;align-items:center;gap:4px;">
                                    Select <i class="fas fa-arrow-right" style="font-size:8px;"></i>
                                </span>
                            </div>
                        </div>
                    </template>
                    <template x-if="digitalIdSuggestions.length === 0">
                        <div style="text-align:center;padding:35px 10px;color:var(--muted);">
                            <i class="fas fa-search" style="font-size:26px;opacity:0.3;margin-bottom:8px;display:block;"></i>
                            <div style="font-size:12px;font-weight:800;">No residents found.</div>
                            <div style="font-size:10px;margin-top:2px;">Try typing a different name or resident code.</div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- 2. SELECTED RESIDENT DIGITAL ID VIEWER & ACTIONS --}}
            <div x-show="digitalIdResident" x-transition>
                {{-- Emergency contact fields --}}
                <div class="section-blk">
                    <div class="section-blk-ttl"><i class="fas fa-phone"></i> In Case of Emergency (Printed on Back of ID)</div>
                    <div class="fgrid3" style="gap:9px;">
                        <div><label class="flbl">Contact Person Name</label><input type="text" x-model="ecName" placeholder="e.g. Marinel V. Ganitnit" class="finput"></div>
                        <div><label class="flbl">Contact Person Address</label><input type="text" x-model="ecAddress" placeholder="e.g. Blk.6 Lot.7 Burol Main" class="finput"></div>
                        <div><label class="flbl">Contact Number</label><input type="text" x-model="ecNum" placeholder="09XXXXXXXXX" pattern="\d{11}" maxlength="11" minlength="11" title="Please enter exactly 11 digits (e.g. 09123456789)" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="finput"></div>
                    </div>
                </div>

                <div style="display:flex;gap:7px;margin-bottom:14px;justify-content:center;">
                    <button @click="digitalIdCardView='front'" :class="digitalIdCardView==='front'?'btn-grad btn-grad-sm':'btn-plain btn-edit'" class="btn-grad-sm"><i class="fas fa-id-card"></i> Front View</button>
                    <button @click="digitalIdCardView='back'; $nextTick(()=>{ if(digitalIdResident) generateQRCode(digitalIdResident.id,digitalIdResident.code) })"
                            :class="digitalIdCardView==='back'?'btn-grad btn-grad-sm':'btn-plain btn-edit'" class="btn-grad-sm"><i class="fas fa-qrcode"></i> Back View</button>
                </div>

                {{-- ── ID FRONT: EXACT 3-ROW FORMAT (TOP: HEADER, CENTER: INFO & PHOTO ALIGNED, BOTTOM: SIGNATURE & DATES) ── --}}
                <div x-show="digitalIdCardView==='front'" id="digital-id-front"
                     style="width:480px;height:295px;background:#ffffff url('{{ asset('images/id_front_bg.jpg') }}') center/cover no-repeat;border:1.5px solid #000;border-radius:10px;overflow:hidden;position:relative;font-family:Arial,Helvetica,sans-serif;margin:0 auto;box-shadow:0 8px 24px rgba(0,0,0,0.18);box-sizing:border-box;padding:12px 18px 3px;display:flex;flex-direction:column;justify-content:space-between;">
                    
                    {{-- 1. TOP ROW: Header with Dasma logo, Center text, SM2 logo --}}
                    <div style="display:flex;align-items:center;justify-content:center;gap:12px;margin-bottom:8px;">
                        <img src="{{ asset('images/dasma.png') }}" style="width:44px;height:44px;object-fit:contain;flex-shrink:0;" onerror="this.style.display='none'">
                        <div style="text-align:center;line-height:1.15;">
                            <div style="font-size:8px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.03em;">REPUBLIC OF THE PHILIPPINES</div>
                            <div style="font-size:8px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.03em;">PROVINCE OF CAVITE</div>
                            <div style="font-size:8px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.03em;">CITY OF DASMARIÑAS</div>
                            <div style="font-size:14px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.02em;margin-top:2px;">BARANGAY SAN MIGUEL 2</div>
                        </div>
                        <img src="{{ asset('images/circlelogo.png') }}" style="width:44px;height:44px;object-fit:contain;flex-shrink:0;" onerror="this.style.display='none'">
                    </div>

                    {{-- 2. CENTER ROW: Photo aligned with Resident Name --}}
                    <div style="display:flex;gap:16px;align-items:flex-start;margin-top:2px;">
                        {{-- Left: 1x1 Photo + 1-Line ID Number (Top aligned with Resident Name) --}}
                        <div style="width:110px;flex-shrink:0;text-align:center;padding-top:13px;">
                            <label style="cursor:pointer;" title="Click or Drag photo to upload" x-data="{ isDragging: false }">
                                <div style="width:95px;height:95px;aspect-ratio:1/1;border:1px solid #000;border-radius:0;overflow:hidden;background:#e2e8f0;position:relative;display:flex;align-items:center;justify-content:center;margin:0 auto;"
                                     :style="isDragging ? 'border-color:#1a5276; background:#eff6ff;' : ''"
                                     @dragover.prevent="isDragging = true"
                                     @dragleave.prevent="isDragging = false"
                                     @drop.prevent="isDragging = false; if($event.dataTransfer.files[0]){ $refs.idPhotoInput.files = $event.dataTransfer.files; $refs.idPhotoInput.dispatchEvent(new Event('change')); }">
                                    <template x-if="digitalIdResident && digitalIdResident.photo">
                                        <img :src="digitalIdResident.photo" style="width:100%;height:100%;aspect-ratio:1/1;object-fit:cover;display:block;">
                                    </template>
                                    <template x-if="!digitalIdResident || !digitalIdResident.photo">
                                        <div style="width:100%;height:100%;aspect-ratio:1/1;display:flex;align-items:center;justify-content:center;background:#cbd5e1;color:#475569;">
                                            <i class="fas fa-user" style="font-size:36px;opacity:0.6;"></i>
                                        </div>
                                    </template>
                                </div>
                                <input type="file" x-ref="idPhotoInput" accept="image/*" style="display:none;" @change="const f=$event.target.files[0];if(f&&digitalIdResident){const rd=new FileReader();rd.onload=e=>{digitalIdResident={...digitalIdResident,photo:e.target.result}};rd.readAsDataURL(f)}">
                            </label>
                            <div style="font-size:7px;font-weight:900;color:#000;text-transform:uppercase;margin-top:3px;letter-spacing:0.04em;">BARANGAY ID NO.</div>
                            <div style="font-size:8.5px;font-weight:900;color:#000;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:110px;margin:1px auto 0;" x-text="digitalIdResident ? (digitalIdResident.digital_id_number || digitalIdResident.code) : 'BSM2-26-11-008'"></div>
                        </div>

                        {{-- Right: Resident Details (Aligned at top with photo) --}}
                        <div style="flex:1;min-width:0;padding-top:13px;">
                            <div style="font-size:8px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:2px;">RESIDENCE IDENTIFICATION CARD</div>
                            <div style="font-size:14.5px;font-weight:900;color:#000;text-transform:uppercase;line-height:1.15;margin-bottom:6px;word-break:break-word;" x-text="digitalIdResident ? digitalIdResident.name.toUpperCase() : 'FIRSTNAME MIDDLE SURNAME'"></div>

                            <div style="font-size:7px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:1px;">ADDRESS:</div>
                            <div style="font-size:9.5px;font-weight:900;color:#000;text-transform:uppercase;line-height:1.3;margin-bottom:6px;word-break:break-word;" x-text="digitalIdResident ? (digitalIdResident.address || 'BLK 3 LOT 11 BARANGAY SAN MIGUEL II DASMARIÑAS CAVITE').toUpperCase() : 'BLK 3 LOT 11 BARANGAY SAN MIGUEL II DASMARIÑAS CAVITE'"></div>

                            <div style="font-size:7px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:1px;">DATE OF BIRTH:</div>
                            <div style="font-size:11px;font-weight:900;color:#000;text-transform:uppercase;" x-text="digitalIdResident && digitalIdResident.birthday ? new Date(digitalIdResident.birthday).toLocaleDateString('en-US',{year:'numeric',month:'long',day:'numeric'}).toUpperCase() : 'JANUARY 1, 2000'"></div>
                        </div>
                    </div>

                    {{-- 3. BOTTOM ROW: Signature on Left, Date Issue in Center, Valid Until on Right (further down at bottom edge) --}}
                    <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:12px;margin-top:auto;padding-bottom:0px;margin-bottom:0px;">
                        {{-- Left: Signature Line & Label --}}
                        <div style="width:110px;text-align:center;">
                            <div style="border-top:1.5px solid #000;width:100px;margin:0 auto;padding-top:2px;">
                                <div style="font-size:6.5px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.05em;">SIGNATURE</div>
                            </div>
                        </div>

                        {{-- Center: Date Issue --}}
                        <div style="text-align:left;">
                            <div style="font-size:6.5px;font-weight:800;color:#000;text-transform:uppercase;letter-spacing:0.05em;">DATE ISSUE</div>
                            <div style="font-size:9.5px;font-weight:900;color:#000;" x-text="digitalIdIssueDate"></div>
                        </div>

                        {{-- Right: Valid Until --}}
                        <div style="text-align:right;padding-right:6px;">
                            <div style="font-size:6.5px;font-weight:800;color:#000;text-transform:uppercase;letter-spacing:0.05em;">VALID UNTIL</div>
                            <div style="font-size:9.5px;font-weight:900;color:#000;" x-text="digitalIdValidUntil"></div>
                        </div>
                    </div>
                </div>

                {{-- ── ID BACK: EXACT FORMAT WITH 2X2 QR AND PUNONG BRGY NAME (NO SIGNATURE) ── --}}
                <div x-show="digitalIdCardView==='back'" id="digital-id-back"
                     style="width:480px;height:295px;background:#ffffff;border:1.5px solid #000;border-radius:10px;overflow:hidden;position:relative;font-family:Arial,Helvetica,sans-serif;margin:0 auto;box-shadow:0 8px 24px rgba(0,0,0,0.18);box-sizing:border-box;padding:12px 16px;display:flex;flex-direction:column;justify-content:space-between;">
                    
                    {{-- Watermark Logo in Center (more visible) --}}
                    <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;opacity:0.38;pointer-events:none;z-index:0;">
                        <img src="{{ asset('images/circlelogo.png') }}" style="width:235px;height:235px;object-fit:contain;" onerror="this.src='{{ asset('images/brgysm2_logo.png') }}'">
                    </div>

                    <div style="position:relative;z-index:1;display:flex;flex-direction:column;height:100%;justify-content:space-between;">
                        {{-- Emergency Box --}}
                        <div style="border:2px solid #000;border-radius:0;padding:6px 10px;background:rgba(255,255,255,0.7);text-align:center;position:relative;margin-bottom:8px;">
                            <div style="font-size:8px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.04em;">— CONTACT PERSON IN CASE OF EMERGENCY —</div>
                            <div style="font-size:12.5px;font-weight:900;color:#000;text-transform:uppercase;margin:2px 0 1px;" x-text="(ecName || 'MARINEL V. GANITNIT').toUpperCase()"></div>
                            <div style="font-size:9.5px;font-weight:900;color:#000;text-transform:uppercase;margin-bottom:1px;" x-text="(ecAddress || 'BLK.6 LOT.7 CHESTER VILLE BUROL MAIN').toUpperCase()"></div>
                            <div style="font-size:9.5px;font-weight:900;color:#000;text-transform:uppercase;">CONTACT NO: <span x-text="ecNum || '0917-933-0940'"></span></div>
                        </div>

                        {{-- Terms and Conditions text --}}
                        <div style="margin-top:0;">
                            <div style="font-size:8.5px;font-weight:900;color:#000;text-transform:uppercase;margin-bottom:2px;">THIS CARD IS NON - TRANSFERABLE</div>
                            <div style="font-size:7px;font-weight:800;color:#000;line-height:1.35;margin-bottom:4px;">THE CARD HOLDER IS A BONAFIDE RESIDENT OF THIS BARANGAY. IF THIS ID IS FOUND , KINDLY RETURN TO THE BARANGAY SECRETARIAT.</div>
                            
                            <div style="font-size:8px;font-weight:900;color:#000;margin-bottom:1px;">NOTE:</div>
                            <div style="font-size:7px;font-weight:800;color:#000;line-height:1.35;">THIS CARD IS VALID IF SIGNED BY THE BARANGAY CHAIRMAN. LOSS OF THIS CARD MUST BE REPORTED IMMEDIATELY TO THE BARANGAY HALL.</div>
                        </div>

                        {{-- Bottom Row: Punong Barangay text on Left, 2x2 QR Code on Right --}}
                        <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-top:auto;padding-bottom:1px;">
                            <div>
                                <div style="font-size:11px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.02em;">HON. MARVIN M. BENIS</div>
                                <div style="font-size:7.5px;font-weight:800;color:#000;text-transform:uppercase;letter-spacing:0.05em;margin-top:1px;">PUNONG BARANGAY</div>
                            </div>

                            {{-- 2x2 QR Code Box Canvas --}}
                            <div style="text-align:center;flex-shrink:0;">
                                <div style="width:86px;height:86px;aspect-ratio:1/1;background:#ffffff;border:2px solid #000;border-radius:4px;padding:2px;display:flex;align-items:center;justify-content:center;box-sizing:border-box;">
                                    <div id="qr-main-canvas" style="width:80px;height:80px;aspect-ratio:1/1;display:flex;align-items:center;justify-content:center;"></div>
                                </div>
                                <div style="font-size:6px;font-weight:900;color:#000;margin-top:1px;white-space:nowrap;max-width:86px;overflow:hidden;text-overflow:ellipsis;" x-text="digitalIdResident?(digitalIdResident.digital_id_number || digitalIdResident.code):''"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;gap:9px;margin-top:14px;">
                    <button @click="openDigitalId=false" class="btn-plain btn-edit">Cancel</button>
                    <form :action="`/office/digital-id/generate-manual/${digitalIdResident.id}`" method="POST" style="margin:0;">
                        @csrf
                        <input type="hidden" name="ecName" :value="ecName">
                        <input type="hidden" name="ecNum" :value="ecNum">
                        <button type="submit" class="btn-plain btn-green" style="padding:10px 17px;font-size:11px;font-weight:900;letter-spacing:.05em;"><i class="fas fa-id-badge"></i> Generate ID</button>
                    </form>
                    <button @click="printDigitalId(digitalIdResident)" class="btn-grad"><i class="fas fa-print"></i> Print ID</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ══ UPLOAD CUSTOM TEMPLATE / FORMAT MODAL ══ --}}
<div x-show="templateUploadModal" x-cloak class="modal-ov" x-transition style="z-index:9999;">
    <div class="modal-box" style="max-width:520px;" @click.away="templateUploadModal=false">
        <div class="modal-in" style="padding:22px 24px;">
            <div class="modal-hd">
                <div class="modal-ttl">
                    <div class="modal-ico" style="background:#eff6ff;color:#0E5393;"><i class="fas fa-cloud-upload-alt"></i></div>
                    <div>
                        <div>Upload Custom Report Format / Template</div>
                        <div style="font-size:9px;color:var(--muted);font-weight:600;text-transform:none;">Upload updated LGU / DILG Office & Registry template (PDF, DOCX, XLSX, JPG, PNG)</div>
                    </div>
                </div>
                <button type="button" @click="templateUploadModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
            </div>

            <form action="{{ route('department.reports.upload_template') }}" method="POST" enctype="multipart/form-data" style="margin-top:14px;">
                @csrf
                <input type="hidden" name="department" value="Office">
                <div style="background:#f8fafc;border:2px dashed #cbd5e1;border-radius:12px;padding:24px 16px;text-align:center;cursor:pointer;margin-bottom:16px;"
                     @click="$refs.customTemplateInput.click()">
                    <i class="fas fa-file-upload" style="font-size:32px;color:#0E5393;margin-bottom:8px;"></i>
                    <div style="font-size:12px;font-weight:800;color:var(--text);" x-ref="customTemplateTxt">Click to select new template file</div>
                    <div style="font-size:9px;color:var(--muted);margin-top:4px;">Supported: PDF, XLSX, DOCX, PNG, JPG (Max: 15MB)</div>
                    <input type="file" x-ref="customTemplateInput" name="template_file" style="display:none;" required
                           @change="$refs.customTemplateTxt.innerText = $event.target.files[0]?.name || 'File selected'">
                </div>

                <div style="display:flex;justify-content:flex-end;gap:8px;">
                    <button type="button" @click="templateUploadModal=false" class="btn-plain btn-edit">Cancel</button>
                    <button type="submit" class="btn-plain btn-green" style="background:#0E5393;color:#fff;">
                        <i class="fas fa-cloud-upload-alt"></i> Upload & Set Active Template
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ══ PHOTO LIGHTBOX MODAL ══ --}}
<div id="photo-lightbox" onclick="closeLightbox()" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.85);align-items:center;justify-content:center;backdrop-filter:blur(4px);padding:20px;">
    <div onclick="event.stopPropagation()" style="position:relative;max-width:90vw;max-height:90vh;display:inline-block;">
        <button type="button" onclick="closeLightbox()" title="Close (Esc)"
                style="position:absolute;top:10px;right:10px;z-index:100;background:#ffffff;color:#0f172a;border:2px solid #ffffff;border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:16px;font-weight:900;box-shadow:0 4px 14px rgba(0,0,0,0.5);transition:all .15s;"
                onmouseover="this.style.background='#dc2626';this.style.color='#ffffff';this.style.borderColor='#dc2626';"
                onmouseout="this.style.background='#ffffff';this.style.color='#0f172a';this.style.borderColor='#ffffff';">
            <i class="fas fa-times"></i>
        </button>
        <img id="photo-lightbox-img" src="" alt="Preview" style="display:block;max-width:85vw;max-height:85vh;object-fit:contain;border-radius:14px;box-shadow:0 25px 60px rgba(0,0,0,0.6);">
    </div>
</div>
