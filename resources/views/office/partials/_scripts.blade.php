<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
function officePortal() {
    return {
        activeTab: localStorage.getItem('brgy_office_tab') || 'dashboard',
        activeFilter: '',
        searchQuery: '',
        searchOpen: false,
        showProfile: false,
        openAddModal: false,
        openImportModal: false,
        openEditModal: false,
        openAddPetModal: false,
        openPetTracker: false,
        openArchivedPetsModal: false,
        templateUploadModal: false,
        officeRep: {
            province: 'Cavite',
            city: 'Dasmariñas',
            barangay: 'San Miguel 2',
            monthYear: '{{ strtoupper(now()->format('F Y')) }}',
            totalResidents: {{ $users->count() }},
            newResidentsMonth: {{ $users->where('created_at', '>=', now()->startOfMonth())->count() }},
            seniorCount: {{ $seniors->count() }},
            pwdCount: {{ $pwds->count() }},
            soloParentCount: {{ $soloParents->count() }},
            votersCount: {{ $users->where('is_voter', true)->count() }},
            nonVotersCount: {{ $nonVoters->count() }},
            householdCount: {{ $households->count() }},
            clearanceIssued: {{ $documentRequests->where('document_type', 'Barangay Clearance')->count() }},
            indigencyIssued: {{ $documentRequests->where('document_type', 'Certificate of Indigency')->count() }},
            residencyIssued: {{ $documentRequests->where('document_type', 'Certificate of Residency')->count() }},
            businessClearanceIssued: {{ $documentRequests->where('document_type', 'Business Clearance')->count() }},
            firstTimeJobseekerIssued: {{ $documentRequests->where('document_type', 'First Time Jobseeker')->count() }},
            get totalDocsIssued() {
                return (Number(this.clearanceIssued)||0) + (Number(this.indigencyIssued)||0) + (Number(this.residencyIssued)||0) + (Number(this.businessClearanceIssued)||0) + (Number(this.firstTimeJobseekerIssued)||0);
            },
            digitalIdIssued: {{ \App\Models\DigitalId::where('status', 'generated')->count() }},
            registeredPets: {{ $petCount ?? 0 }},
            preparedBy: 'BARANGAY SECRETARY / OFFICE ADMIN',
            preparedRole: 'Barangay Secretary',
            notedBy: 'MARVIN M. BENIS',
            notedRole: 'Punong Barangay'
        },
        printOfficeReport() {
            printOfficeReportHelper();
        },
        searchArchivedPets: '',
        petTypeSelection: '',
        petPhotoPreview: null,
        vaccineProofPreview: null,
        photoPreview: null,
        editPhotoPreview: null,
        occupationStatus: 'unemployed',
        editUser: {},
        selectedUser: {},
        openDigitalId: false,
        digitalIdSearch: '',
        digitalIdResident: null,
        digitalIdOpen: false,
        digitalIdCardView: 'front',
        ecName: '',
        ecNum: '',
        ecAddress: '',
        openFamilyModal: false,
        selectedFamilyMembers: [],
        selectedHeadName: '',
        archiveModal: false,
        archiveTarget: { id: null, name: '' },
        archivePetModal: false,
        archivePetTarget: { id: null, name: '' },
        showReadyModal: false,
        selectedReq: { id: null, type: '', name: '', date: '', time: '08:00' },
        docFilter: 'all',
        docStatusFilter: 'all',
        masterlistSubView: 'active',
        searchArchivedRes: '',
        filterArchivedResGender: '',
        filterArchivedResClass: '',

        // Document Specifics
        openDoc: '',
        docOwnerSearch: '',
        docOwnerSelectedId: '',
        docOwnerName: '',
        docOwnerAddress: '',
        docOwnerGender: '',
        docOwnerIsVoter: false,
        docOwnerIsNonVoter: false,
        docOwnerBirthplace: '',
        docOwnerBdayRaw: '',
        docPurpose: '',
        docClearanceType: 'General',
        docOrNo: '',
        docCedulaNo: '',
        docCTCDate: '',
        docCTCPlace: '',
        docAge: '',
        docBlk: '', docLot: '', docResidenceSince: '', docLandlordName: '',
        docRentalAddress: '', docRentalDate: '', docMoveDate: '', docFamilyMembers: '',
        docClaimantName: '', docClaimantRelation: '', docSpouseName: '',
        docBirthMonth: '', docBirthYear: '', docCompanyName: '', docTradeName: '',
        docOwnerBusiness: '', docNonOpSince: '', docChildName: '', docFatherName: '',
        docMotherName: '', docBirthAttendant: '', docBornFrom: '', docWardName: '',
        docWardRelation: '', docWardAge: '', docPartnerName: '', docLivingSince: '',
        docIssuedBy: localStorage.getItem('brgy_office_issued_by') || '{{ addslashes(Auth::user()?->first_name ?? '') }} {{ addslashes(Auth::user()?->last_name ?? '') }}'.trim() || 'Office Staff',
        docPosition: localStorage.getItem('brgy_office_position') || 'Barangay Staff',
        docOwnerAge: '',
        docDate: new Date().toISOString().split('T')[0],
        get docDateFormatted() { return this.formatDocDate(this.docDate); },
        get docDayOrdinal()    { return new Date(this.docDate).getDate(); },
        get docMonth()         { return new Date(this.docDate).toLocaleDateString('en-PH', { month: 'long' }); },
        get docYear()          { return new Date(this.docDate).getFullYear(); },

        clearDocOwner() {
            this.docOwnerSearch = '';
            this.docOwnerSelectedId = null;
            this.docOwnerName = '';
            this.docOwnerAddress = '';
            this.docOwnerGender = '';
            this.docOwnerIsVoter = false;
            this.docOwnerIsNonVoter = false;
            this.docOwnerBirthplace = '';
            this.docOwnerBdayRaw = '';
            this.docAge = '';
            this.docOwnerAge = '';
            this.docPurpose = '';
            this.docIssuedBy = localStorage.getItem('brgy_office_issued_by') || '{{ addslashes(Auth::user()?->first_name ?? '') }} {{ addslashes(Auth::user()?->last_name ?? '') }}'.trim() || 'Office Staff';
            this.docPosition = localStorage.getItem('brgy_office_position') || 'Barangay Staff';
        },

        allResidents: window._allResidents,

        get docResidentSuggestions() {
            if (this.docOwnerSearch.length < 1) return [];
            const q = this.docOwnerSearch.toLowerCase();
            return this.allResidents.filter(r => {
                const n = (r.first_name + ' ' + r.last_name).toLowerCase();
                return n.includes(q) || r.code.toLowerCase().includes(q);
            }).slice(0, 8);
        },
        selectDocResident(r) {
            this.docOwnerSearch = r.name + ' — ' + r.code;
            this.docOwnerSelectedId = r.id;
            this.docOwnerName = r.name;
            this.docOwnerAddress = r.address;
            this.docOwnerGender = r.gender;
            this.docOwnerIsVoter = r.is_voter;
            this.docOwnerIsNonVoter = r.is_non_voter;
            this.docOwnerBirthplace = r.birthplace || '';
            this.docOwnerBdayRaw = r.birthday || '';
            let age = this.getAge(r.birthday);
            this.docAge = age;
        },
        get digitalIdSuggestions() {
            let list = this.allResidents;
            if (this.digitalIdSearch && this.digitalIdSearch.trim().length > 0) {
                const q = this.digitalIdSearch.toLowerCase().trim();
                list = list.filter(r => {
                    const n = ((r.first_name || '') + ' ' + (r.last_name || '') + ' ' + (r.name || '')).toLowerCase();
                    return n.includes(q) || (r.code && r.code.toLowerCase().includes(q)) || (r.resident_code && r.resident_code.toLowerCase().includes(q));
                });
            }
            return list;
        },
        selectDigitalIdResident(r) {
            if (!r) return;
            this.digitalIdResident = {
                ...r,
                name: r.name || ((r.first_name || '') + ' ' + (r.last_name || '')).trim(),
                code: r.resident_code || r.code || 'BSM2-26-11-008',
                photo: r.photo || null,
                address: r.address || 'BLK 3 LOT 11 BARANGAY SAN MIGUEL II DASMARIÑAS CAVITE',
                birthday: r.birthday || '',
                digital_id_number: r.digital_id_number || r.resident_code || r.code || 'BSM2-26-11-008'
            };
            this.digitalIdSearch = this.digitalIdResident.name;
            this.digitalIdOpen = false;
            this.digitalIdCardView = 'front';
            this.ecName = r.emergency_contact_name || this.ecName || '';
            this.ecNum = r.emergency_contact_number || this.ecNum || '';
            this.ecAddress = r.emergency_contact_address || this.ecAddress || '';
            this.$nextTick(() => {
                generateQRCode(this.digitalIdResident.id, this.digitalIdResident.code);
            });
        },
        get digitalIdIssueDate() {
            const d = new Date();
            return String(d.getMonth() + 1).padStart(2, '0') + '/' + String(d.getDate()).padStart(2, '0') + '/' + d.getFullYear();
        },
        get digitalIdValidUntil() {
            const d = new Date();
            d.setFullYear(d.getFullYear() + 1);
            return String(d.getMonth() + 1).padStart(2, '0') + '/' + String(d.getDate()).padStart(2, '0') + '/' + d.getFullYear();
        },
        get suggestions() {
            if (this.searchQuery.length < 1) return [];
            const q = this.searchQuery.toLowerCase();
            return this.allResidents.filter(r => {
                const n = (r.first_name + ' ' + r.last_name).toLowerCase();
                return n.includes(q) || r.code.toLowerCase().includes(q);
            }).slice(0, 8);
        },
        get filteredResidents() {
            let list = this.allResidents;
            if (this.searchQuery.length > 0) {
                const q = this.searchQuery.toLowerCase();
                list = list.filter(r => {
                    const n = (r.first_name + ' ' + r.last_name).toLowerCase();
                    return n.includes(q) || r.code.toLowerCase().includes(q);
                });
            }
            if (this.activeFilter === 'birthday') {
                const m = new Date().getMonth() + 1;
                list = list.filter(r => {
                    if (!r.birthday) return false;
                    return new Date(r.birthday).getMonth() + 1 === m;
                });
            } else if (this.activeFilter === 'senior') list = list.filter(r => r.is_senior);
            else if (this.activeFilter === 'nonvoter') list = list.filter(r => r.is_non_voter);
            else if (this.activeFilter === 'pwd') list = list.filter(r => r.is_pwd);
            else if (this.activeFilter === 'solo') list = list.filter(r => r.is_single_parent);
            else if (this.activeFilter === 'bedridden') list = list.filter(r => r.is_bedridden);
            else if (this.activeFilter === 'heads') list = list.filter(r => r.is_household_head);
            else if (this.activeFilter === '4ps') list = list.filter(r => r.memberships && r.memberships.includes('4Ps'));
            else if (this.activeFilter === 'kdbm') list = list.filter(r => r.memberships && r.memberships.includes('KDBM'));
            else if (this.activeFilter === 'any_membership') list = list.filter(r => r.memberships && r.memberships.length > 0);
            return list;
        },
        selectSuggestion(r) {
            this.searchQuery = r.name;
            this.searchOpen = false;
            this.selectedUser = r;
            this.showProfile = true;
        },
        openProfile(r) {
            this.selectedUser = r;
            this.showProfile = true;
        },
        openEdit(id) {
            fetch('/office/' + id + '/edit').then(r => r.json()).then(data => {
                this.editUser = data;
                this.editPhotoPreview = data.photo || null;
                this.openEditModal = true;
            });
        },
        viewFamily(r) {
            this.selectedHeadName = r.name;
            fetch('/office/family/' + r.id).then(res => res.json()).then(data => {
                this.selectedFamilyMembers = data;
                this.openFamilyModal = true;
            });
        },
        formatDate(d) {
            if (!d) return 'N/A';
            return new Date(d).toLocaleDateString('en-PH', { year: 'numeric', month: 'long', day: 'numeric' });
        },
        getAge(d) {
            if (!d) return '';
            const t = new Date(), b = new Date(d);
            let a = t.getFullYear() - b.getFullYear();
            const m = t.getMonth() - b.getMonth();
            if (m < 0 || (m === 0 && t.getDate() < b.getDate())) a--;
            return a + ' yrs old';
        },
        formatDocDate(d) {
            if (!d) return new Date().toLocaleDateString('en-PH', { year: 'numeric', month: 'long', day: 'numeric' });
            return new Date(d).toLocaleDateString('en-PH', { year: 'numeric', month: 'long', day: 'numeric' });
        },
        getNextHouseholdId() {
            const ids = this.allResidents
                .map(r => r.household_id)
                .filter(id => id && id.toString().startsWith('HH-'))
                .map(id => parseInt(id.toString().replace('HH-', '')))
                .filter(num => !isNaN(num));
            const maxId = ids.length > 0 ? Math.max(...ids) : 0;
            return 'HH-' + (maxId + 1).toString().padStart(5, '0');
        },
        init() {
            this.$watch('activeTab', value => localStorage.setItem('brgy_office_tab', value));
            
            // Global listeners for header buttons
            window.addEventListener('open-import-modal', () => this.openImportModal = true);
            window.addEventListener('open-add-modal', () => this.openAddModal = true);
            window.addEventListener('open-digital-id', () => this.openDigitalId = true);

            window.addEventListener('navigate-task', (e) => {
                const detail = e.detail || {};
                if (detail.tab) {
                    this.activeTab = detail.tab;
                }
                if (detail.filter !== undefined) {
                    this.activeFilter = detail.filter;
                }
                if (detail.docFilter !== undefined) {
                    this.docFilter = detail.docFilter;
                } else if (detail.tab === 'requests') {
                    this.docFilter = 'all';
                }
                if (detail.modal === 'petTracker') {
                    this.openPetTracker = true;
                }
                if (detail.modal === 'archivedPets') {
                    this.openArchivedPetsModal = true;
                }

                if (detail.rowId) {
                    const findAndHighlight = (attempts = 0) => {
                        const el = document.getElementById(detail.rowId);
                        if (el) {
                            el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            el.classList.remove('highlight-row');
                            void el.offsetWidth;
                            el.classList.add('highlight-row');
                            setTimeout(() => {
                                el.classList.remove('highlight-row');
                            }, 4000);
                        } else if (attempts < 15) {
                            setTimeout(() => findAndHighlight(attempts + 1), 100);
                        }
                    };
                    setTimeout(() => findAndHighlight(), 150);
                }
            });
        }
    };
}

window.goToNotificationTask = function(options) {
    window.dispatchEvent(new CustomEvent('navigate-task', { detail: options }));
};

function generateQRCode(residentId,residentCode){
    if(!residentCode) return;
    const container = document.getElementById('qr-main-canvas');
    if(!container) return;
    container.innerHTML = '';
    const url=window.location.origin+'/verify-id/'+residentCode;
    try{
        new QRCode(container, {
            text: url,
            width: 90,
            height: 90,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.M
        });
    }catch(e){ console.warn('QR error',e); }
}
function printDigitalId(resident){
    if(!resident) return;
    generateQRCode(resident.id, resident.code);
    setTimeout(()=>{
        const front = document.getElementById('digital-id-front');
        const back = document.getElementById('digital-id-back');
        if(!front || !back) return;
        let backHtml = back.outerHTML;
        const container = document.getElementById('qr-main-canvas');
        if(container){
            const canvas = container.querySelector('canvas');
            if(canvas){
                const src = canvas.toDataURL('image/png');
                backHtml = backHtml.split(container.outerHTML).join(`<div id="qr-main-canvas" style="width:90px;height:90px;"><img src="${src}" style="width:100%;height:100%!important;display:block;"></div>`);
            }
        }
        const win = window.open('', '_blank');
        win.document.write(`<!DOCTYPE html>
<html>
<head>
    <title>Digital ID - ${resident.name}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        @page {
            size: 8.5in 11in portrait; /* Short bond paper (Letter) */
            margin: 0;
        }
        html, body {
            width: 8.5in;
            height: 11in;
            margin: 0 auto;
            background: #ffffff;
            font-family: Arial, sans-serif;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 11in;
            padding: 0.5in 0;
        }
        .sheet-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 28px;
            margin: auto;
        }
        .card-block {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .card-label {
            font-size: 9px;
            font-weight: 800;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 6px;
        }
        .id-wrapper {
            display: inline-block;
        }
        .id-wrapper > div {
            border: 1.5px dashed #475569 !important;
            border-radius: 8px !important;
            margin: 0 auto !important;
            box-shadow: none !important;
            display: block !important;
        }
        img { max-width: 100%; }
        @media print {
            body { padding: 0; }
        }
    </style>
</head>
<body>
    <div class="sheet-center">
        <div class="card-block">
            <div class="card-label">▲ FRONT ID ▲</div>
            <div class="id-wrapper">${front.outerHTML}</div>
        </div>
        <div class="card-block">
            <div class="card-label">▼ BACK ID ▼</div>
            <div class="id-wrapper">${backHtml}</div>
        </div>
    </div>
    <script>
        window.onload = function() {
            setTimeout(() => { window.print(); }, 500);
        };
    <\/script>
</body>
</html>`);
        win.document.close();
    }, 200);
}
function printDoc(elementId){
    const el=document.getElementById(elementId);
    if(!el) return;
    const win=window.open('','_blank');
    win.document.write(`<!DOCTYPE html><html><head><title></title>
    <style>@page{size:A4 portrait;margin:15mm 18mm 10mm 18mm;}html{-webkit-print-color-adjust:exact;}*{box-sizing:border-box;}html,body{margin:0;padding:0;width:100%;}body{font-family:'Times New Roman',serif;font-size:11pt;color:#000;padding-top:6mm;}p{margin:2px 0;line-height:1.45;}strong{font-weight:bold;}img{display:inline-block;}</style></head><body>${el.innerHTML}</body></html>`);
    win.document.close();
    setTimeout(()=>{ win.print(); },700);
}
// ── Photo Lightbox ──
function viewPhoto(url) {
    document.getElementById('photo-lightbox-img').src = url;
    document.getElementById('photo-lightbox').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('photo-lightbox').style.display = 'none';
    document.getElementById('photo-lightbox-img').src = '';
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLightbox();
});

function printOfficeReportHelper() {
    const el = document.getElementById('office-printable-report');
    if (!el) return;
    const printContent = el.innerHTML;
    const printWindow = window.open('', '_blank', 'width=1100,height=800');
    printWindow.document.write('<!DOCTYPE html><html><head><title>MONTHLY BARANGAY REGISTRY & DOCUMENT ISSUANCE REPORT</title><link href="https://fonts.googleapis.com/css2?family=Times+New+Roman&display=swap" rel="stylesheet"><style>@page{size:landscape;margin:10mm;}body{font-family:\'Times New Roman\',serif;margin:0;padding:15px;color:#000;background:#fff;}input{border:none!important;background:transparent!important;font-family:inherit!important;font-size:inherit!important;font-weight:inherit!important;text-align:center!important;}table{width:100%;border-collapse:collapse;font-size:10px;}th,td{border:1px solid #000;padding:4px 2px;}</style></head><body>' + printContent + '</body></html>');
    printWindow.document.close();
    printWindow.focus();
    setTimeout(() => { printWindow.print(); printWindow.close(); }, 400);
}

// ── Document Template Customization Helpers ──
function insertTag(buttonEl, tag) {
    const form = buttonEl.closest('form');
    if (!form) return;
    const textarea = form.querySelector('textarea[name="body_template"]');
    if (!textarea) return;
    const start = textarea.selectionStart || 0;
    const end = textarea.selectionEnd || 0;
    const text = textarea.value;
    textarea.value = text.substring(0, start) + tag + text.substring(end);
    textarea.focus();
    textarea.setSelectionRange(start + tag.length, start + tag.length);
}

function renderTemplateBody(rawText, scope) {
    if (!rawText) return '';
    const dateFormatted = scope.formatDocDate ? scope.formatDocDate(scope.docDate) : (scope.docDate || '');
    return rawText
        .replace(/\{NAME\}/gi, `<strong>${scope.docOwnerName || '______________________________'}</strong>`)
        .replace(/\{AGE\}/gi, `<strong>${scope.docOwnerAge || scope.docAge || '___'}</strong>`)
        .replace(/\{ADDRESS\}/gi, `<strong>${scope.docOwnerAddress || 'Barangay San Miguel II, Dasmariñas City, Cavite'}</strong>`)
        .replace(/\{PURPOSE\}/gi, `<strong>${scope.docPurpose || '______________________________'}</strong>`)
        .replace(/\{DATE\}/gi, `<strong>${dateFormatted}</strong>`)
        .replace(/\{BIRTHDAY\}/gi, `<strong>${scope.docOwnerBday || '__________________'}</strong>`)
        .replace(/\{BIRTHPLACE\}/gi, `<strong>${scope.docOwnerBirthplace || '__________________'}</strong>`)
        .replace(/\{DAY\}/gi, `<strong>${scope.docDayOrdinal || ''}</strong>`)
        .replace(/\{MONTH\}/gi, `<strong>${scope.docMonth || ''}</strong>`)
        .replace(/\{YEAR\}/gi, `<strong>${scope.docYear || ''}</strong>`);
}

async function saveTemplate(key, formEl) {
    const btn = formEl.querySelector('button[type="submit"]');
    if (btn) btn.disabled = true;
    const formData = new FormData(formEl);
    try {
        const res = await fetch(`/office/document-templates/${key}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });
        const data = await res.json();
        if (data.success) {
            alert('✓ Na-save at nailapat na ang bagong document template!');
            window.location.reload();
        } else {
            alert('Hindi na-save ang template: ' + (data.message || 'May error na naganap.'));
        }
    } catch (err) {
        alert('Error sa pag-save ng template: ' + err.message);
    } finally {
        if (btn) btn.disabled = false;
    }
}

async function resetTemplate(key) {
    if (!confirm('Kumpirmahin: Ibalik sa default layout at wording ang template ng dokumentong ito?')) return;
    try {
        const res = await fetch(`/office/document-templates/${key}/reset`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });
        const data = await res.json();
        if (data.success) {
            alert('✓ Naibalik na sa default barangay template.');
            window.location.reload();
        }
    } catch (err) {
        alert('Error sa pag-reset ng template: ' + err.message);
    }
}
</script>
