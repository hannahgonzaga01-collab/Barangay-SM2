<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script src="{{ asset('js/chart.umd.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        window._officials = @json($officials ?? []);
        window._announcements = @json($announcements ?? []);
        window._events = @json($events ?? []);
        window._residents = @json($resList ?? []);
        window._activeResidents = @json($activeResidents ?? []);
        window._activeDocs = @json($activeDocs ?? []);
        window._allPets = @json($allPets ?? []);
        window._activeIssues = @json($activeIssues ?? []);
        window._activeHouseholds = @json($activeHouseholds ?? []);
        window._reportDocs = @json($reportDocs ?? []);
        window._reportIssues = @json($reportIssues ?? []);
        window._adminMessages = @json($adminMessages ?? []);

        let adminCharts = {};
        function initAdminCharts() {
            if (typeof Chart === 'undefined') {
                setTimeout(initAdminCharts, 100);
                return;
            }
            const cfg = {
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { family: "'Plus Jakarta Sans', sans-serif", weight: '700', size: 11 },
                            padding: 14,
                            usePointStyle: true,
                            pointStyleWidth: 10
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false
            };

            // 1. Document Requests Chart
            const docEl = document.getElementById('docChart');
            if (docEl) {
                try {
                    if (adminCharts['doc']) { adminCharts['doc'].destroy(); }
                    adminCharts['doc'] = new Chart(docEl, {
                        type: 'doughnut',
                        data: {
                            labels: ['Pending', 'Processing', 'Ready', 'Released'],
                            datasets: [{
                                data: [{{ (int)$pendingDocs }}, {{ (int)$processingDocs }}, {{ (int)$readyDocs }}, {{ max(0, (int)$totalDocs - (int)$pendingDocs - (int)$processingDocs - (int)$readyDocs) }}],
                                backgroundColor: ['#d97706', '#0E5393', '#059669', '#94a3b8'],
                                borderWidth: 3,
                                borderColor: '#fff',
                                hoverOffset: 6
                            }]
                        },
                        options: { ...cfg, cutout: '62%' }
                    });
                } catch(e) { console.error('docChart error:', e); }
            }

            // 2. Issues by Department Chart
            const issueEl = document.getElementById('issueChart');
            if (issueEl) {
                try {
                    if (adminCharts['issue']) { adminCharts['issue'].destroy(); }
                    adminCharts['issue'] = new Chart(issueEl, {
                        type: 'doughnut',
                        data: {
                            labels: ['VAWC', 'Peace & Order', 'Justice'],
                            datasets: [{
                                data: [{{ (int)$vawcIssues }}, {{ (int)$peaceIssues }}, {{ (int)$justiceIssues }}],
                                backgroundColor: ['#7c3aed', '#059669', '#0E5393'],
                                borderWidth: 3,
                                borderColor: '#fff',
                                hoverOffset: 6
                            }]
                        },
                        options: { ...cfg, cutout: '62%' }
                    });
                } catch(e) { console.error('issueChart error:', e); }
            }

            // 3. Pet Vaccination Chart
            const petEl = document.getElementById('petChart');
            if (petEl) {
                try {
                    if (adminCharts['pet']) { adminCharts['pet'].destroy(); }
                    adminCharts['pet'] = new Chart(petEl, {
                        type: 'doughnut',
                        data: {
                            labels: ['Vaccinated', 'Unvaccinated', 'Partial'],
                            datasets: [{
                                data: [{{ (int)$vaccinated }}, {{ (int)$unvaccinated }}, {{ max(0, (int)$totalPets - (int)$vaccinated - (int)$unvaccinated) }}],
                                backgroundColor: ['#059669', '#dc2626', '#d97706'],
                                borderWidth: 3,
                                borderColor: '#fff',
                                hoverOffset: 6
                            }]
                        },
                        options: { ...cfg, cutout: '62%' }
                    });
                } catch(e) { console.error('petChart error:', e); }
            }

            // 4. Gender Distribution Chart
            const genderEl = document.getElementById('genderChart');
            if (genderEl) {
                try {
                    if (adminCharts['gender']) { adminCharts['gender'].destroy(); }
                    adminCharts['gender'] = new Chart(genderEl, {
                        type: 'doughnut',
                        data: {
                            labels: ['Male', 'Female'],
                            datasets: [{
                                data: [{{ (int)$male }}, {{ (int)$female }}],
                                backgroundColor: ['#0E5393', '#ec4899'],
                                borderWidth: 3,
                                borderColor: '#fff',
                                hoverOffset: 6
                            }]
                        },
                        options: { ...cfg, cutout: '62%' }
                    });
                } catch(e) { console.error('genderChart error:', e); }
            }

            // 5. Demographics Chart
            const demoEl = document.getElementById('demoChart');
            if (demoEl) {
                try {
                    if (adminCharts['demo']) { adminCharts['demo'].destroy(); }
                    adminCharts['demo'] = new Chart(demoEl, {
                        type: 'bar',
                        data: {
                            labels: ['Seniors', 'PWD', 'Bed-ridden', 'Solo Parents', 'Students', 'Minors', 'Adults', 'Voters', 'Households'],
                            datasets: [{
                                label: 'Count',
                                data: [{{ (int)$seniors }}, {{ (int)$pwds }}, {{ (int)$bedridden }}, {{ (int)$soloParents }}, {{ (int)$students }}, {{ (int)$minors }}, {{ (int)$adults }}, {{ (int)$voters }}, {{ (int)$totalHouseholds }}],
                                backgroundColor: ['rgba(14,83,147,.7)', 'rgba(14,83,147,.65)', 'rgba(220,38,38,.7)', 'rgba(14,83,147,.6)', 'rgba(14,83,147,.55)', 'rgba(14,83,147,.7)', 'rgba(14,83,147,.8)', 'rgba(14,83,147,.9)', 'rgba(3,105,161,.7)'],
                                borderRadius: 8,
                                borderWidth: 0
                            }]
                        },
                        options: {
                            ...cfg,
                            plugins: { ...cfg.plugins, legend: { display: false } },
                            scales: {
                                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,.04)' }, ticks: { font: { family: "'Plus Jakarta Sans', sans-serif", weight: '700', size: 10 }, color: '#94a3b8' } },
                                x: { grid: { display: false }, ticks: { font: { family: "'Plus Jakarta Sans', sans-serif", weight: '700', size: 10 }, color: '#64748b' } }
                            }
                        }
                    });
                } catch(e) { console.error('demoChart error:', e); }
            }
        }
        window.addEventListener('load', initAdminCharts);
        document.addEventListener('DOMContentLoaded', initAdminCharts);
        window.addEventListener('resize', () => {
            Object.values(adminCharts).forEach(c => { if(c && typeof c.resize === 'function') c.resize(); });
        });

        function adminDashboard() {
            return {
                tab: 'overview',
                activeTab: 'overview',
                mobileMenu: false,
                portalsOpen: false,
                annOpen: false,
                evtOpen: false,
                offOpen: false,
                mobileMenuOpen: false,

                /* MODAL FLAGS */
                addAnnModal: false,
                editAnnModal: false,
                addEvtModal: false,
                editEvtModal: false,
                addProjModal: false,
                editProjModal: false,
                addOffModal: false,
                editOffModal: false,
                addSlideModal: false,
                editSlideModal: false,
                searchProj: '',
                
                showResList: false,
                resFilterType: 'all',
                resModalTitle: 'Resident Masterlist',
                showDocsList: false,
                showIssuesList: false,
                showPetsList: false,
                showHouseholdList: false,
                showHouseholdMembersModal: false,
                selectedMembers: [],
                selectedHeadName: '',
                showFilters: false,
                showGlobalResults: false,

                /* EDIT STATE OBJECTS */
                editAnn: {},
                editEvt: {},
                editOff: {},
                editSlide: {},

                /* DATA PREVIEWS */
                annPhotoPreview: null,
                editAnnPhotoPreview: null,
                evtPhotoPreview: null,
                editEvtPhotoPreview: null,
                photoPreview: null,
                editOffPhotoPreview: null,
                slidePhotoPreview: null,
                editSlidePhotoPreview: null,

                /* DATA ARRAYS */
                allRes: window._activeResidents || [],
                allDocs: window._activeDocs || [],
                allIssues: window._activeIssues || [],
                allPets: window._allPets || [],
                allHouseholds: window._activeHouseholds || [],
                allMsgs: window._adminMessages || [],
                backups: [],
                
                /* SEARCH & FILTER */
                resSearchQuery: '',
                docSearchQuery: '',
                petSearchQuery: '',
                householdSearchQuery: '',
                issueSearchQuery: '',
                globalSearchInput: '',
                globalSearchResults: [],
                filterMonth: '',
                filterDept: '',

                openResidentModal(filter = 'all', title = 'Resident Masterlist') {
                    this.resFilterType = filter;
                    this.resModalTitle = title;
                    this.resSearchQuery = '';
                    this.showResList = true;
                },

                openDocsModal() {
                    this.docSearchQuery = '';
                    this.showDocsList = true;
                },

                openPetsModal() {
                    this.petSearchQuery = '';
                    this.showPetsList = true;
                },

                openHouseholdModal() {
                    this.householdSearchQuery = '';
                    this.showHouseholdList = true;
                },

                openHouseholdMembers(h) {
                    if (!h) return;
                    this.selectedMembers = Array.isArray(h.household_members) ? h.household_members : Object.values(h.household_members || {});
                    this.selectedHeadName = (((h.first_name || '') + ' ' + (h.last_name || '')).trim()) || 'Household Head';
                    this.showHouseholdMembersModal = true;
                },

                openIssuesModal() {
                    this.issueSearchQuery = '';
                    this.showIssuesList = true;
                },

                editStaffSecurityModal: false,
                staffSecurityData: {
                    user_id: null,
                    name: '',
                    role: '',
                    email: '',
                    question_preset: '',
                    security_question: '',
                    security_answer: '',
                    show_answer: false
                },

                openStaffSecurityModal(staff) {
                    if (!staff) return;
                    this.staffSecurityData.user_id = staff.id;
                    this.staffSecurityData.name = staff.name;
                    this.staffSecurityData.role = staff.role;
                    this.staffSecurityData.email = staff.email;
                    this.staffSecurityData.security_question = staff.security_question || 'What is the Barangay Station Code?';
                    this.staffSecurityData.security_answer = staff.security_answer || '';
                    this.staffSecurityData.show_answer = false;

                    const presets = [
                        'What is the Barangay Station Code?',
                        'What is your first pet\'s name?',
                        'What is your mother\'s maiden name?',
                        'What was your childhood nickname?',
                        'What is the official Barangay Emergency Hotline?'
                    ];

                    if (presets.includes(this.staffSecurityData.security_question)) {
                        this.staffSecurityData.question_preset = this.staffSecurityData.security_question;
                    } else {
                        this.staffSecurityData.question_preset = 'custom';
                    }
                    this.editStaffSecurityModal = true;
                },

                get filteredResidentList() {
                    const list = Array.isArray(this.allRes) ? this.allRes : Object.values(this.allRes || {});
                    const q = (this.resSearchQuery || '').toLowerCase().trim();
                    const currentMonth = new Date().getMonth() + 1;
                    return list.filter(r => {
                        if (!r) return false;
                        if (this.resFilterType === 'voter' && !r.is_voter) return false;
                        if (this.resFilterType === 'non_voters' && r.is_voter) return false;
                        if (this.resFilterType === 'pending' && r.is_voter) return false;
                        if (this.resFilterType === 'senior' && !r.is_senior) return false;
                        if (this.resFilterType === 'pwd' && !r.is_pwd) return false;
                        if (this.resFilterType === 'bedridden' && !r.is_bedridden) return false;
                        if (this.resFilterType === 'solo_parent' && !r.is_single_parent) return false;
                        if (this.resFilterType === 'student' && !r.is_student) return false;
                        if (this.resFilterType === 'with_account' && !r.user_id) return false;
                        
                        let calcAge = r.age !== null && r.age !== undefined && r.age !== '' ? Number(r.age) : NaN;
                        if (isNaN(calcAge) && r.birthday) {
                            calcAge = Math.floor((new Date() - new Date(r.birthday)) / 31557600000);
                        }

                        if (this.resFilterType === 'minor') {
                            if (isNaN(calcAge) || calcAge >= 18) return false;
                        }
                        if (this.resFilterType === 'adult') {
                            if (isNaN(calcAge) || calcAge < 18 || calcAge > 59) return false;
                        }
                        if (this.resFilterType === 'birthday') {
                            let bmonth = r.bmonth;
                            if (!bmonth && r.birthday) {
                                bmonth = new Date(r.birthday).getMonth() + 1;
                            }
                            if (Number(bmonth) !== Number(currentMonth)) return false;
                        }

                        if (q) {
                            const fullName = ((r.first_name || '') + ' ' + (r.last_name || '') + ' ' + (r.middle_name || '')).toLowerCase();
                            const code = (r.resident_code || '').toLowerCase();
                            const addr = (r.address || '').toLowerCase();
                            if (!fullName.includes(q) && !code.includes(q) && !addr.includes(q)) {
                                return false;
                            }
                        }
                        return true;
                    });
                },

                get filteredDocsList() {
                    const list = Array.isArray(this.allDocs) ? this.allDocs : Object.values(this.allDocs || {});
                    const q = (this.docSearchQuery || '').toLowerCase().trim();
                    return list.filter(d => {
                        if (!d) return false;
                        if (!q) return true;
                        const type = (d.document_type || '').toLowerCase();
                        const user = d.user ? ((d.user.first_name || '') + ' ' + (d.user.last_name || '') + ' ' + (d.user.name || '')).toLowerCase() : '';
                        const guest = ((d.guest_first_name || '') + ' ' + (d.guest_last_name || '')).toLowerCase();
                        const status = (d.status || '').toLowerCase();
                        return type.includes(q) || user.includes(q) || guest.includes(q) || status.includes(q);
                    });
                },

                get filteredPetsList() {
                    const list = Array.isArray(this.allPets) ? this.allPets : Object.values(this.allPets || {});
                    const q = (this.petSearchQuery || '').toLowerCase().trim();
                    return list.filter(p => {
                        if (!p) return false;
                        if (!q) return true;
                        const name = (p.pet_name || '').toLowerCase();
                        const type = (p.pet_type || '').toLowerCase();
                        const breed = (p.breed || '').toLowerCase();
                        const owner = p.resident ? ((p.resident.first_name || '') + ' ' + (p.resident.last_name || '')).toLowerCase() : '';
                        const status = (p.vaccine_status || '').toLowerCase();
                        return name.includes(q) || type.includes(q) || breed.includes(q) || owner.includes(q) || status.includes(q);
                    });
                },

                get filteredHouseholdList() {
                    const list = Array.isArray(this.allHouseholds) ? this.allHouseholds : Object.values(this.allHouseholds || {});
                    const q = (this.householdSearchQuery || '').toLowerCase().trim();
                    return list.filter(h => {
                        if (!h) return false;
                        if (!q) return true;
                        const name = ((h.first_name || '') + ' ' + (h.last_name || '')).toLowerCase();
                        const addr = (h.address || '').toLowerCase();
                        const code = (h.resident_code || '').toLowerCase();
                        return name.includes(q) || addr.includes(q) || code.includes(q);
                    });
                },

                get filteredIssuesList() {
                    const list = Array.isArray(this.allIssues) ? this.allIssues : Object.values(this.allIssues || {});
                    const q = (this.issueSearchQuery || '').toLowerCase().trim();
                    return list.filter(i => {
                        if (!i) return false;
                        if (!q) return true;
                        const type = (i.issue_type || '').toLowerCase();
                        const dept = (i.department || '').toLowerCase();
                        const name = (i.complainant_name || (i.user ? (i.user.first_name + ' ' + i.user.last_name) : '')).toLowerCase();
                        const status = (i.status || '').toLowerCase();
                        return type.includes(q) || dept.includes(q) || name.includes(q) || status.includes(q);
                    });
                },

                /* REPORTS */
                adminReportSection: 'overall',
                deptReportFilter: 'all',
                reportType: 'full',
                reportMonth: '',
                reportYear: '{{ date('Y') }}',
                reportDocs: window._reportDocs || [],
                reportIssues: window._reportIssues || [],
                viewReportModal: false,
                activeReport: null,
                activeReportData: {},

                openReportModal(rep) {
                    this.activeReport = rep;
                    let d = rep.report_data;
                    if (typeof d === 'string') {
                        try { d = JSON.parse(d); } catch(e) { d = {}; }
                    }
                    this.activeReportData = (d && typeof d === 'object') ? d : {};
                    this.viewReportModal = true;
                },

                closeReportModal() {
                    this.viewReportModal = false;
                    this.activeReport = null;
                    this.activeReportData = {};
                },

                downloadActiveReportPdf() {
                    if (!this.activeReport) return;
                    const el = document.getElementById('report-modal-paper');
                    if (!el) return;
                    
                    const dept = this.activeReport.department || 'Department';
                    const title = this.activeReport.report_title || 'Report';
                    const period = this.activeReport.reporting_period || '';
                    const cleanName = (dept + '_' + title + '_' + period).replace(/[^a-zA-Z0-9_-]/g, '_');
                    
                    if (typeof html2pdf !== 'undefined') {
                        const opt = {
                            margin: [6, 6, 6, 6],
                            filename: cleanName + '.pdf',
                            image: { type: 'jpeg', quality: 0.98 },
                            html2canvas: { scale: 2, useCORS: true, logging: false },
                            jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
                        };
                        html2pdf().set(opt).from(el).save();
                    } else {
                        window.print();
                    }
                },

                printReportNewTab() {
                    if (this.activeReport) {
                        window.open('/department-reports/' + this.activeReport.id + '?print=1', '_blank');
                    }
                },

                vawcRep: {
                    province: 'Cavite',
                    city: 'Dasmariñas',
                    barangay: 'San Miguel 2',
                    monthYear: '{{ strtoupper(now()->format('F Y')) }}',
                    hasDesk: 'YES',
                    gadFund: '70,500.00',
                    bcpcFund: '52,194.00',
                    hasLogbook: 'Yes',
                    casesHandled: 4,
                    physicalAbuse: 1,
                    economicAbuse: 1,
                    sexualAbuse: 0,
                    psychologicalAbuse: 2,
                    get totalVictims() {
                        return (Number(this.physicalAbuse)||0) + (Number(this.economicAbuse)||0) + (Number(this.sexualAbuse)||0) + (Number(this.psychologicalAbuse)||0);
                    },
                    refPnp: 0,
                    refCourt: 0,
                    issuedBpos: 0,
                    refMedical: 0,
                    get totalActed() {
                        return (Number(this.refPnp)||0) + (Number(this.refCourt)||0) + (Number(this.issuedBpos)||0) + (Number(this.refMedical)||0);
                    },
                    preparedBy: 'MA. TERESA L. CALAWIN',
                    preparedRole: 'VAWC Desk Officer',
                    notedBy: 'MARVIN M. BENIS',
                    notedRole: 'Punong Barangay'
                },

                get filteredDocs() {
                    return (this.reportDocs || []).filter(d => {
                        const m = this.reportMonth ? d.month == this.reportMonth : true;
                        const y = this.reportYear ? d.year == this.reportYear : true;
                        return m && y;
                    });
                },
                get filteredIssues() {
                    return (this.reportIssues || []).filter(i => {
                        const m = this.reportMonth ? i.month == this.reportMonth : true;
                        const y = this.reportYear ? i.year == this.reportYear : true;
                        return m && y;
                    });
                },

                /* VIEW FILTERS */
                offViewMode: 'grid',
                searchOff: '',
                searchAnn: '',
                searchEvt: '',

                /* MESSAGES */
                selectedMsg: null,
                replyText: '',
                replySending: false,
                replySent: false,
                msgFilter: 'all',

                /* CUSTOM CONFIRM */
                confirmModal: {
                    show: false,
                    title: '',
                    message: '',
                    confirmText: 'CONFIRM',
                    cancelText: 'CANCEL',
                    onConfirm: null,
                    type: 'danger'
                },

                /* FUNCTIONS */
                triggerConfirm(title, message, callback, type = 'danger', confirmBtn = 'CONFIRM') {
                    this.confirmModal.title = title;
                    this.confirmModal.message = message;
                    this.confirmModal.onConfirm = callback;
                    this.confirmModal.type = type;
                    this.confirmModal.confirmText = confirmBtn;
                    this.confirmModal.show = true;
                },
                executeConfirm() {
                    if (this.confirmModal.onConfirm) this.confirmModal.onConfirm();
                    this.confirmModal.show = false;
                },

                openMsg(msg) {
                    this.selectedMsg = msg;
                    this.replyText = '';
                    this.replySent = false;
                    if (!msg.read_at) {
                        const token = document.querySelector('meta[name=csrf-token]')?.content;
                        fetch('/admin/messages/' + msg.id + '/read', {
                            method: 'PATCH',
                            headers: { 'X-CSRF-TOKEN': token }
                        }).then(() => {
                            msg.read_at = true;
                            const idx = this.allMsgs.findIndex(m => m.id === msg.id);
                            if (idx !== -1) this.allMsgs[idx].read_at = true;
                        });
                    }
                },

                sendReply() {
                    if (!this.replyText || !this.selectedMsg) return;
                    this.replySending = true;
                    const token = document.querySelector('meta[name=csrf-token]')?.content;
                    fetch('/admin/messages/' + this.selectedMsg.id + '/reply', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ reply: this.replyText })
                    }).then(r => r.json()).then((data) => {
                        this.replySending = false;
                        this.replySent = true;
                        if (this.selectedMsg) {
                            this.selectedMsg.admin_reply = this.replyText;
                            this.selectedMsg.replied_at = data.replied_at || true;
                            const idx = this.allMsgs.findIndex(m => m.id === this.selectedMsg.id);
                            if (idx !== -1) {
                                this.allMsgs[idx].admin_reply = this.selectedMsg.admin_reply;
                                this.allMsgs[idx].replied_at = this.selectedMsg.replied_at;
                            }
                        }
                        this.replyText = '';
                    }).catch(() => { this.replySending = false; });
                },

                get filteredMessages() {
                    if (this.msgFilter === 'unread') return (this.allMsgs || []).filter(m => !m.read_at);
                    if (this.msgFilter === 'read') return (this.allMsgs || []).filter(m => m.read_at);
                    return this.allMsgs || [];
                },

                get unreadCount() {
                    return (this.allMsgs || []).filter(m => !m.read_at).length;
                },

                performGlobalSearch() {
                    const q = this.globalSearchInput.toLowerCase().trim();
                    if (!q) {
                        this.showGlobalResults = false;
                        return;
                    }

                    let results = [];
                    if(window._officials) {
                        window._officials.forEach(o => {
                            if(((o.name||'') + ' ' + (o.position||'')).toLowerCase().includes(q)) {
                                results.push({ type: 'Official', id: o.id, title: o.name, subtitle: o.position||'', icon: 'fas fa-user-tie', tab: 'officials', searchVar: 'searchOff' });
                            }
                        });
                    }
                    if(window._announcements) {
                        window._announcements.forEach(a => {
                            let textContent = a.content ? a.content.replace(/(<([^>]+)>)/gi, '') : '';
                            if(((a.title||'') + ' ' + textContent).toLowerCase().includes(q)) {
                                results.push({ type: 'Announcement', id: a.id, title: a.title, subtitle: textContent.substring(0,60)+'...', icon: 'fas fa-bullhorn', tab: 'announcements', searchVar: 'searchAnn' });
                            }
                        });
                    }
                    if(window._events) {
                        window._events.forEach(e => {
                            let loc = e.location || '';
                            if(((e.title||'') + ' ' + loc + ' ' + (e.description||'')).toLowerCase().includes(q)) {
                                results.push({ type: 'Event', id: e.id, title: e.title, subtitle: (e.day_label||'') + (loc ? (' • ' + loc) : ''), icon: 'fas fa-calendar-alt', tab: 'announcements', searchVar: 'searchAnn' });
                            }
                        });
                    }
                    (this.allMsgs || []).forEach(m => {
                        if(((m.subject||'') + ' ' + (m.name||'')).toLowerCase().includes(q)) {
                            results.push({ type: 'Message', id: m.id, title: m.subject, subtitle: 'From: ' + (m.name||'Anonymous'), icon: 'fas fa-envelope', tab: 'messages', searchVar: '' });
                        }
                    });

                    this.globalSearchResults = results.slice(0, 15);
                    this.showGlobalResults = true;
                },

                goToResult(res) {
                    this.tab = res.tab;
                    this.showGlobalResults = false;
                    this.globalSearchInput = '';
                    if(res.searchVar) {
                        this[res.searchVar] = res.title;
                    } else if (res.tab === 'messages') {
                        const msg = (this.allMsgs || []).find(m => m.id === res.id);
                        if(msg) this.openMsg(msg);
                    }
                },

                applyFilters() {
                    if (!this.filterMonth) {
                        this.showGlobalResults = false;
                        return;
                    }
                    let results = [];
                    if (window._residents) {
                        window._residents.forEach(r => {
                            if(r.bmonth == this.filterMonth) {
                                results.push({ type: 'Resident (Bday)', id: r.id, title: r.name, subtitle: 'Born: ' + (r.bdate_raw ? new Date(r.bdate_raw).toLocaleDateString() : 'Unknown'), icon: 'fas fa-birthday-cake', tab: 'demographics', searchVar: '' });
                            }
                        });
                    }
                    this.globalSearchResults = results.slice(0, 50);
                    this.showGlobalResults = true;
                    this.showFilters = false;
                },

                fetchBackups() {
                    fetch('/admin/backups').then(r=>r.json()).then(data=>{ this.backups = data; }).catch(()=>{});
                },

                init() {
                    this.allRes = window._activeResidents || [];
                    this.allDocs = window._activeDocs || [];
                    this.allIssues = window._activeIssues || [];
                    this.allPets = window._allPets || [];
                    this.allHouseholds = window._activeHouseholds || [];
                    this.allMsgs = window._adminMessages || [];
                    this.reportDocs = window._reportDocs || [];
                    this.reportIssues = window._reportIssues || [];
                    this.fetchBackups();
                    
                    initAdminCharts();
                    setTimeout(initAdminCharts, 250);
                    setTimeout(initAdminCharts, 800);

                    this.$watch('tab', (val) => {
                        if (val === 'overview' || val === 'demographics') {
                            this.$nextTick(() => {
                                setTimeout(initAdminCharts, 60);
                                setTimeout(initAdminCharts, 300);
                            });
                        }
                    });
                }
            };
        }
    </script>
    <script>
        function makePhotoUploader(initialPhotos = []) {
            return {
                photos: (initialPhotos || []).map(u => ({ url: u, file: null })),
                dt: new DataTransfer(),
                addFiles(files) {
                    if (!files || !files.length) return;
                    Array.from(files).forEach(file => {
                        if (this.photos.length < 6) {
                            this.dt.items.add(file);
                            const reader = new FileReader();
                            reader.onload = e => {
                                this.photos.push({ url: e.target.result, file: file });
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                    if (this.$refs.fileInput) this.$refs.fileInput.files = this.dt.files;
                },
                removePhoto(idx) {
                    this.photos.splice(idx, 1);
                    const newDt = new DataTransfer();
                    this.photos.forEach(p => { if (p.file) newDt.items.add(p.file); });
                    this.dt = newDt;
                    if (this.$refs.fileInput) this.$refs.fileInput.files = this.dt.files;
                }
            };
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --brand: #0E5393;
            --brand-dark: #04192D;
            --brand-darker: #000052;
            --body-bg: #f1f5f9;
            --border: #e2e8f0;
            --text: #0f172a;
            --muted: #64748b;
            --light: #94a3b8;
            --card-shadow: 0 4px 24px rgba(4, 25, 45, 0.10), 0 1.5px 6px rgba(0, 0, 0, 0.05);
            --btn-grad: linear-gradient(135deg, #0E5393 0%, #04192D 100%);
            --r: 14px;
            --max-w: 1440px;
            --gap: 20px;
            --pad: 24px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--body-bg);
            min-height: 100vh;
        }

        [x-cloak] {
            display: none !important;
        }

        /* TOPBAR */
        .topbar {
            background: linear-gradient(135deg, #000052 0%, #04192D 60%, #0E5393 100%);
            height: 58px;
            position: sticky;
            top: 0;
            z-index: 200;
            box-shadow: 0 2px 20px rgba(0, 0, 52, .45);
            display: flex;
            align-items: center;
        }

        .tb-inner {
            width: 100%;
            max-width: var(--max-w);
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 var(--pad);
        }

        .tb-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .tb-logo {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, .3);
        }

        .tb-name {
            font-size: 13px;
            font-weight: 900;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .tb-sub {
            font-size: 9px;
            color: rgba(255, 255, 255, .5);
            font-weight: 600;
            text-transform: uppercase;
        }

        .tb-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 12px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 800;
            color: rgba(255, 255, 255, .8);
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: .04em;
            transition: all .15s;
            cursor: pointer;
            background: none;
            border: none;
            font-family: inherit;
            white-space: nowrap;
        }

        .tb-btn:hover,
        .tb-btn.is-active {
            background: rgba(255, 255, 255, .18);
            color: #fff;
        }

        .tb-btn i {
            font-size: 11px;
        }

        .tb-dropdown {
            position: relative;
        }

        .tb-drop-menu {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            min-width: 210px;
            background: #fff;
            border-radius: 13px;
            box-shadow: 0 8px 32px rgba(0, 0, 52, .18);
            border: 1px solid #e2e8f0;
            z-index: 300;
            overflow: hidden;
        }

        .tb-drop-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 15px;
            font-size: 11px;
            font-weight: 700;
            color: #0f172a;
            text-decoration: none;
            transition: all .1s;
            border-bottom: 1px solid #f1f5f9;
        }

        .tb-drop-item:last-child {
            border-bottom: none;
        }

        .tb-drop-item:hover {
            background: #eff6ff;
            color: #0E5393;
        }

        .tb-drop-item i {
            width: 16px;
            text-align: center;
            color: #0E5393;
        }

        .tb-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tb-user {
            font-size: 10px;
            font-weight: 700;
            color: rgba(255, 255, 255, .65);
        }

        .tb-logout {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 12px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 800;
            color: rgba(255, 255, 255, .7);
            text-transform: uppercase;
            background: rgba(220, 38, 38, .2);
            border: 1px solid rgba(220, 38, 38, .3);
            cursor: pointer;
            font-family: inherit;
            transition: all .15s;
        }

        .tb-logout:hover {
            background: rgba(220, 38, 38, .5);
            color: #fff;
        }

        /* Hamburger mobile menu */
        .tb-hamburger {
            display: none;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, .12);
            border: 1.5px solid rgba(255, 255, 255, .25);
            border-radius: 9px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: all .15s;
            flex-shrink: 0;
        }

        .tb-hamburger:hover {
            background: rgba(255, 255, 255, .22);
        }

        .mobile-menu-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            z-index: 490;
            backdrop-filter: blur(3px);
        }

        .mobile-menu {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            width: 280px;
            background: linear-gradient(160deg, #000052 0%, #04192D 60%, #0E5393 100%);
            z-index: 500;
            padding: 0;
            overflow-y: auto;
            box-shadow: -10px 0 40px rgba(0, 0, 52, .5);
            display: flex;
            flex-direction: column;
        }

        .mob-menu-head {
            padding: 18px 20px 14px;
            border-bottom: 1px solid rgba(255, 255, 255, .12);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .mob-menu-title {
            font-size: 12px;
            font-weight: 900;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .mob-close-btn {
            background: rgba(255, 255, 255, .12);
            border: none;
            color: #fff;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
        }

        .mob-section-lbl {
            font-size: 9px;
            font-weight: 900;
            color: rgba(255, 255, 255, .4);
            text-transform: uppercase;
            letter-spacing: .1em;
            padding: 14px 20px 6px;
        }

        .mob-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            font-size: 12px;
            font-weight: 700;
            color: rgba(255, 255, 255, .85);
            text-decoration: none;
            border-bottom: 1px solid rgba(255, 255, 255, .06);
            transition: all .12s;
            cursor: pointer;
            background: none;
            border-left: 3px solid transparent;
            font-family: inherit;
            text-align: left;
            width: 100%;
        }

        .mob-item:hover,
        .mob-item.active {
            background: rgba(255, 255, 255, .1);
            color: #fff;
            border-left-color: rgba(255, 255, 255, .5);
        }

        .mob-item i {
            width: 18px;
            text-align: center;
            font-size: 13px;
            color: rgba(255, 255, 255, .6);
        }

        .mob-item:hover i,
        .mob-item.active i {
            color: #fff;
        }

        .mob-footer {
            padding: 18px 20px;
            border-top: 1px solid rgba(255, 255, 255, .12);
            margin-top: auto;
        }

        /* WRAP */
        .dash-wrap {
            width: 100%;
            max-width: var(--max-w);
            margin: 0 auto;
            padding: var(--pad);
            padding-bottom: 48px;
        }

        /* GREETING */
        .greeting {
            background: linear-gradient(135deg, #000052 0%, #04192D 55%, #0E5393 100%);
            border-radius: var(--r);
            padding: 22px 26px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            box-shadow: var(--card-shadow);
        }

        .greeting h1 {
            font-size: 20px;
            font-weight: 900;
            color: #fff;
        }

        .greeting p {
            font-size: 11px;
            color: rgba(255, 255, 255, .55);
            font-weight: 600;
            margin-top: 3px;
        }

        .g-stats {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .gs {
            text-align: center;
        }

        .gs-n {
            font-size: 24px;
            font-weight: 900;
            color: #fff;
            line-height: 1;
        }

        .gs-l {
            font-size: 8px;
            font-weight: 700;
            color: rgba(255, 255, 255, .5);
            text-transform: uppercase;
            letter-spacing: .07em;
            margin-top: 2px;
        }

        /* TABS */
        .tab-bar {
            display: flex;
            gap: 5px;
            background: #fff;
            padding: 5px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 22px;
            border: 1px solid var(--border);
            flex-wrap: wrap;
        }

        .tab-btn {
            flex: 1;
            min-width: 90px;
            padding: 9px 12px;
            border-radius: 9px;
            border: none;
            background: transparent;
            font-family: inherit;
            font-size: 10px;
            font-weight: 800;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .05em;
            cursor: pointer;
            transition: all .18s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .tab-btn.active {
            background: var(--btn-grad);
            color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 82, .25);
        }

        .tab-btn:not(.active):hover {
            background: #f8fafc;
            color: var(--text);
        }

        .tcnt {
            font-size: 9px;
            padding: 1px 6px;
            border-radius: 99px;
            background: rgba(14, 83, 147, .1);
            color: var(--brand);
        }

        .tab-btn.active .tcnt {
            background: rgba(255, 255, 255, .2);
            color: #fff;
        }

        .tcnt-red {
            background: rgba(220, 38, 38, .15);
            color: #dc2626;
        }

        .tab-btn.active .tcnt-red {
            background: rgba(255, 255, 255, .2);
            color: #fff;
        }

        /* CARDS */
        .card {
            background: #fff;
            border-radius: var(--r);
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(4, 25, 45, .05);
            overflow: hidden;
            margin-bottom: 18px;
        }

        .card-head {
            padding: 14px 18px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
        }

        .card-title {
            font-size: 10px;
            font-weight: 900;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: .09em;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .card-title i {
            color: var(--brand);
        }

        .cbadge {
            font-size: 9px;
            background: #eff6ff;
            color: var(--brand);
            font-weight: 900;
            padding: 3px 9px;
            border-radius: 99px;
        }

        .cbadge-red {
            background: #fee2e2;
            color: #dc2626;
        }

        .cbadge-green {
            background: #dcfce7;
            color: #15803d;
        }

        /* STAT GRID */
        .sg {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: var(--gap);
            margin-bottom: 20px;
        }

        .sc {
            background: #fff;
            border-radius: var(--r);
            box-shadow: var(--card-shadow);
            padding: 16px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            border: 1px solid rgba(4, 25, 45, .04);
            height: 100%;
            min-height: 82px;
            transition: transform .2s, box-shadow .2s;
            cursor: pointer !important;
            pointer-events: auto !important;
            user-select: none;
        }

        .sc:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(4, 25, 45, 0.12);
        }

        .sc-ico {
            width: 44px;
            height: 44px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sc-ico i {
            font-size: 18px;
        }

        .sc-n {
            font-size: 26px;
            font-weight: 900;
            color: var(--text);
            line-height: 1;
        }

        .sc-l {
            font-size: 9px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-top: 2px;
        }

        /* CHART GRID */
        .chart-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: var(--gap);
            margin-bottom: 18px;
            align-items: stretch;
        }

        .chart-box {
            background: #fff;
            border-radius: var(--r);
            box-shadow: var(--card-shadow);
            padding: 20px;
            border: 1px solid rgba(4, 25, 45, .04);
        }

        .chart-title {
            font-size: 10px;
            font-weight: 900;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: .09em;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .chart-title i {
            color: var(--brand);
        }

        /* DEMO CARDS */
        .demo-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: var(--gap);
            margin-bottom: 18px;
        }

        .dmcard {
            background: #fff;
            border-radius: var(--r);
            box-shadow: var(--card-shadow);
            padding: 14px 16px;
            border: 1px solid rgba(4, 25, 45, .04);
        }

        .dm-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 9px;
        }

        .dm-ico {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dm-ico i {
            font-size: 14px;
        }

        .dm-n {
            font-size: 26px;
            font-weight: 900;
            color: var(--text);
            line-height: 1;
        }

        .dm-l {
            font-size: 9px;
            font-weight: 800;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 8px;
        }

        .bar-bg {
            height: 6px;
            background: #f1f5f9;
            border-radius: 99px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            border-radius: 99px;
        }

        .bar-pct {
            font-size: 9px;
            font-weight: 700;
            color: var(--muted);
            margin-top: 4px;
            text-align: right;
        }

        /* GENDER */
        .gender-wrap {
            background: #fff;
            border-radius: var(--r);
            box-shadow: var(--card-shadow);
            padding: 18px;
            margin-bottom: 18px;
            border: 1px solid rgba(4, 25, 45, .04);
        }

        .gbar {
            height: 22px;
            border-radius: 99px;
            overflow: hidden;
            display: flex;
            margin: 12px 0 8px;
        }

        .gbar-m {
            background: linear-gradient(90deg, #000052, #0E5393);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 900;
            color: #fff;
        }

        .gbar-f {
            background: linear-gradient(90deg, #be185d, #ec4899);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 900;
            color: #fff;
        }

        .glegend {
            display: flex;
            gap: 18px;
        }

        .gl {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 11px;
            font-weight: 700;
            color: var(--muted);
        }

        .gldot {
            width: 11px;
            height: 11px;
            border-radius: 50%;
        }

        /* OFFICIALS */
        .off-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            padding: 16px;
        }

        .off-card {
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px;
            text-align: center;
        }

        .off-photo-wrap {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            overflow: hidden;
            margin: 0 auto 10px;
            border: 3px solid var(--brand);
            box-shadow: 0 2px 10px rgba(0, 0, 0, .1);
            background: #e2e8f0;
            flex-shrink: 0;
            aspect-ratio: 1/1;
        }

        .off-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            display: block;
        }

        .off-name {
            font-size: 12px;
            font-weight: 900;
            color: var(--text);
            line-height: 1.3;
        }

        .off-pos {
            font-size: 9px;
            font-weight: 700;
            color: var(--brand);
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-top: 3px;
        }

        .off-term {
            font-size: 9px;
            color: var(--muted);
            font-weight: 600;
            margin-top: 4px;
        }

        .off-acts {
            display: flex;
            gap: 5px;
            justify-content: center;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        /* ANN & EVENT ITEMS */
        .ann-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 13px 18px;
            border-bottom: 1px solid #f8fafc;
        }

        .ann-item:last-child {
            border-bottom: none;
        }

        .ann-tag {
            font-size: 8px;
            font-weight: 900;
            text-transform: uppercase;
            padding: 2px 8px;
            border-radius: 99px;
            display: inline-block;
            margin-bottom: 4px;
        }

        .ann-title {
            font-size: 13px;
            font-weight: 800;
            color: var(--text);
        }

        .ann-body {
            font-size: 11px;
            color: var(--muted);
            font-weight: 600;
            margin-top: 3px;
            line-height: 1.5;
        }

        .ann-date {
            font-size: 9px;
            color: var(--light);
            font-weight: 600;
            margin-top: 5px;
        }

        .ann-actions {
            display: flex;
            gap: 5px;
            flex-shrink: 0;
        }

        .evt-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 13px 18px;
            border-bottom: 1px solid #f8fafc;
        }

        .evt-item:last-child {
            border-bottom: none;
        }

        .evt-day {
            background: var(--btn-grad);
            color: #fff;
            border-radius: 10px;
            width: 42px;
            height: 42px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .evt-day-num {
            font-size: 13px;
            font-weight: 900;
            line-height: 1;
        }

        .evt-day-sm {
            font-size: 7px;
            font-weight: 700;
            text-transform: uppercase;
            opacity: .8;
        }

        /* MESSAGES */
        .msg-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 16px 20px;
            border-bottom: 1px solid #f1f5f9;
            transition: background .1s;
            cursor: pointer;
        }

        .msg-item:last-child {
            border-bottom: none;
        }

        .msg-item:hover {
            background: #f8fafc;
        }

        .msg-item.unread {
            background: #eff6ff;
        }

        .msg-item.unread:hover {
            background: #dbeafe;
        }

        .msg-avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            object-fit: cover;
            flex-shrink: 0;
            font-size: 13px;
            font-weight: 900;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: var(--btn-grad);
        }

        .msg-sender {
            font-size: 13px;
            font-weight: 900;
            color: var(--text);
        }

        .msg-subject {
            font-size: 12px;
            font-weight: 800;
            color: var(--brand);
            margin-top: 2px;
        }

        .msg-preview {
            font-size: 11px;
            color: var(--muted);
            font-weight: 600;
            margin-top: 3px;
            line-height: 1.4;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            max-width: 600px;
        }

        .msg-time {
            font-size: 10px;
            color: var(--light);
            font-weight: 600;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .msg-unread-dot {
            width: 9px;
            height: 9px;
            background: #0E5393;
            border-radius: 50%;
            flex-shrink: 0;
            margin-top: 5px;
        }

        .msg-detail-box {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px;
            margin: 0 20px 16px;
        }

        .msg-reply-bar {
            background: #f8fafc;
            border-top: 2px solid var(--border);
            padding: 16px 20px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        /* REPORT */
        .report-section {
            background: #fff;
            border-radius: var(--r);
            box-shadow: var(--card-shadow);
            padding: 28px 32px;
            margin-bottom: 18px;
            border: 1px solid rgba(4, 25, 45, .04);
        }

        @media print {
            @page { margin: 0.5in; }

            .topbar,
            .tab-bar,
            .no-print {
                display: none !important;
            }

            body {
                background: #fff;
            }

            .report-section {
                box-shadow: none;
                border: none;
                padding: 0;
                margin: 0;
            }

            .dash-wrap {
                padding: 0;
                margin: 0;
            }

            .greeting {
                display: none;
            }
        }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            font-family: inherit;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: .05em;
            text-transform: uppercase;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            transition: all .18s;
            white-space: nowrap;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--btn-grad);
            color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 82, .28);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(0, 0, 82, .38);
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 9px;
        }

        .btn-warn {
            background: linear-gradient(135deg, #d97706, #92400e);
            color: #fff;
        }

        .btn-success {
            background: linear-gradient(135deg, #059669, #064e3b);
            color: #fff;
        }

        .btn-ghost {
            background: #f1f5f9;
            color: #475569;
            box-shadow: none;
        }

        .btn-ghost:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc2626, #7f1d1d);
            color: #fff;
        }

        .btn-edit {
            background: #eff6ff;
            color: var(--brand);
            box-shadow: none;
        }

        .btn-edit:hover {
            background: var(--brand);
            color: #fff;
        }

        /* FORMS */
        .flbl {
            font-size: 9px;
            font-weight: 800;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .06em;
            display: block;
            margin-bottom: 4px;
        }

        .finput {
            width: 100%;
            padding: 9px 12px;
            background: #f8fafc;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
            color: var(--text);
            outline: none;
            transition: border-color .15s;
        }

        .finput:focus {
            border-color: var(--brand);
            background: #fff;
        }

        .finput::placeholder {
            color: var(--light);
            font-weight: 500;
        }

        .fgrid2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .fgrid3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
        }

        .fgrp {
            margin-bottom: 12px;
        }

        .fselect {
            appearance: none;
            cursor: pointer;
        }

        /* MODAL */
        .modal-ov {
            position: fixed;
            inset: 0;
            z-index: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 14px;
            background: rgba(0, 0, 18, .65);
            backdrop-filter: blur(5px);
        }

        .modal-box {
            background: #fff;
            width: 100%;
            max-width: 540px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 52, .35);
            border-bottom: 5px solid var(--brand);
            max-height: 92vh;
            overflow-y: auto;
        }

        .modal-in {
            padding: 22px;
        }

        .modal-hd {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--border);
        }

        .modal-ttl {
            font-size: 13px;
            font-weight: 900;
            color: var(--text);
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .mico {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: #eff6ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mico i {
            color: var(--brand);
            font-size: 12px;
        }

        .mclose {
            background: none;
            border: none;
            color: var(--light);
            font-size: 19px;
            cursor: pointer;
        }

        .mclose:hover {
            color: #dc2626;
        }

        /* TOAST */
        .toast {
            position: fixed;
            top: 16px;
            right: 16px;
            z-index: 9999;
            background: #059669;
            color: #fff;
            padding: 11px 18px;
            border-radius: 11px;
            box-shadow: var(--card-shadow);
            font-weight: 800;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        /* EMPTY */
        .empty-st {
            padding: 36px;
            text-align: center;
            color: var(--light);
        }

        .empty-st i {
            font-size: 28px;
            display: block;
            margin-bottom: 8px;
            opacity: .2;
        }

        .empty-st p {
            font-size: 11px;
            font-weight: 700;
        }

        @media(max-width:1400px) {
            /* Removed shrinking max-width logic to ensure consistent sizing on zoom out */
        }

        @media(max-width:1200px) {
            .sg {
                grid-template-columns: repeat(2, 1fr);
            }
            .demo-grid, .off-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media(max-width:1024px) {
            .chart-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }
        }

        @media(max-width:768px) {
            .tb-hamburger {
                display: flex;
                margin-left: auto;
            }

            .tb-left .tb-dropdown,
            .tb-right {
                display: none !important;
            }

            .dash-wrap {
                padding: 14px 12px 32px;
            }

            .sg {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .chart-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .demo-grid, .off-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .g-stats {
                gap: 12px;
            }

            .greeting h1 {
                font-size: 16px;
            }

            .tab-btn span {
                display: none;
            }

            .tab-bar {
                gap: 3px;
                overflow-x: auto;
                flex-wrap: nowrap;
            }

            .tab-btn {
                min-width: fit-content;
                flex: none;
                padding: 8px 12px;
            }

            .msg-preview {
                max-width: 200px;
            }
        }

        @media(max-width:480px) {
            .sg {
                grid-template-columns: 1fr;
            }

            .demo-grid, .off-grid {
                grid-template-columns: 1fr;
            }

            .fgrid2, .fgrid3 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body x-data="adminDashboard()">

    @if(session('success'))
        <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,3500)"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="toast">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    {{-- ══ TOPBAR ══ --}}
    <div class="topbar">
            <div class="tb-inner">
                <div class="tb-left">
                    <img src="{{ asset('images/circlelogo.png') }}" class="tb-logo" onerror="this.style.display='none'">
                    <div>
                        <div class="tb-name">Admin Dashboard</div>
                        <div class="tb-sub">Barangay San Miguel II</div>
                    </div>
                    {{-- Portals sits right beside the title on desktop --}}
                    <div class="tb-dropdown" @click.away="portalsOpen=false" style="margin-left:4px;">
                        <button class="tb-btn" @click="portalsOpen=!portalsOpen">
                            <i class="fas fa-th-large"></i> Portals
                            <i class="fas fa-chevron-down" style="font-size:8px;"
                                :style="portalsOpen?'transform:rotate(180deg);transition:.2s':''"></i>
                        </button>
                        <div x-show="portalsOpen" x-cloak x-transition class="tb-drop-menu">
                            <a href="/office" class="tb-drop-item"><i class="fas fa-users-cog"></i> Office Portal</a>
                            <a href="/justice" class="tb-drop-item"><i class="fas fa-gavel"></i> Justice Portal</a>
                            <a href="/vawc" class="tb-drop-item"><i class="fas fa-shield-alt"></i> VAWC Portal</a>
                            <a href="/peace" class="tb-drop-item"><i class="fas fa-shield"></i> Peace & Order</a>
                            <a href="/resident" class="tb-drop-item" target="_blank"><i class="fas fa-globe"></i> Public
                                View</a>
                        </div>
                    </div>
                </div>

                {{-- Mobile: Hamburger --}}
                <button class="tb-hamburger" @click="mobileMenuOpen=true">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="tb-right">
                    <span class="tb-user">{{ Auth::user()->first_name ?? Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="tb-logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ MOBILE SIDE MENU ══ --}}
        <div x-show="mobileMenuOpen" x-cloak>
            {{-- Backdrop --}}
            <div class="mobile-menu-overlay" @click="mobileMenuOpen=false"></div>
            {{-- Slide-in panel --}}
            <div class="mobile-menu" x-transition:enter="transition ease-out duration-250"
                x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform translate-x-0"
                x-transition:leave-end="transform translate-x-full">
                <div class="mob-menu-head">
                    <span class="mob-menu-title"><i class="fas fa-th-large"
                            style="margin-right:7px;"></i>Navigation</span>
                    <button class="mob-close-btn" @click="mobileMenuOpen=false"><i class="fas fa-times"></i></button>
                </div>
                <div class="mob-section-lbl">Portals</div>
                <a href="/office" class="mob-item"><i class="fas fa-users-cog"></i> Office Portal</a>
                <a href="/justice" class="mob-item"><i class="fas fa-gavel"></i> Justice Portal</a>
                <a href="/vawc" class="mob-item"><i class="fas fa-shield-alt"></i> VAWC Portal</a>
                <a href="/peace" class="mob-item"><i class="fas fa-shield"></i> Peace & Order</a>
                <a href="/resident" class="mob-item" target="_blank"><i class="fas fa-globe"></i> Public View</a>
                <div class="mob-section-lbl">Dashboard</div>
                <button class="mob-item" :class="tab==='overview'?'active':''"
                    @click="tab='overview';mobileMenuOpen=false"><i class="fas fa-chart-pie"></i> Overview</button>
                <button class="mob-item" :class="tab==='demographics'?'active':''"
                    @click="tab='demographics';mobileMenuOpen=false"><i class="fas fa-users"></i> Demographics</button>
                <button class="mob-item" :class="tab==='officials'?'active':''"
                    @click="tab='officials';mobileMenuOpen=false"><i class="fas fa-user-tie"></i> Officials</button>
                <button class="mob-item" :class="tab==='announcements'?'active':''"
                    @click="tab='announcements';mobileMenuOpen=false"><i class="fas fa-bullhorn"></i>
                    News & Events</button>

                <button class="mob-item" :class="tab==='reports'?'active':''"
                    @click="tab='reports';mobileMenuOpen=false"><i class="fas fa-file-alt"></i> Reports</button>
                <div class="mob-section-lbl">Quick Actions</div>
                <button class="mob-item" @click="addAnnModal=true;mobileMenuOpen=false"><i class="fas fa-plus-circle"
                        style="color:#4ade80;"></i> New Announcement</button>
                <button class="mob-item" @click="addEvtModal=true;mobileMenuOpen=false"><i class="fas fa-plus-circle"
                        style="color:#4ade80;"></i> New Event</button>
                <button class="mob-item" @click="addOffModal=true;photoPreview=null;mobileMenuOpen=false"><i
                        class="fas fa-plus-circle" style="color:#4ade80;"></i> Add Official</button>
                <div class="mob-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            style="width:100%;padding:11px;background:rgba(220,38,38,.25);border:1px solid rgba(220,38,38,.4);color:#fca5a5;font-family:inherit;font-size:11px;font-weight:800;text-transform:uppercase;border-radius:10px;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="dash-wrap">

            {{-- GREETING --}}
            <div class="greeting">
                <div>
                    <h1>Good {{ now()->timezone('Asia/Manila')->hour < 12 ? 'Morning' : (now()->timezone('Asia/Manila')->hour < 18 ? 'Afternoon' : 'Evening') }},
                        {{ Auth::user()->first_name ?? 'Admin' }}! </h1>
                    <p>{{ now()->timezone('Asia/Manila')->format('l, F d, Y') }} • Barangay San Miguel II Admin Panel</p>
                </div>
                <div class="g-stats">
                    <div class="gs">
                        <div class="gs-n">{{ $totalResidents }}</div>
                        <div class="gs-l">Residents</div>
                    </div>
                    <div class="gs">
                        <div class="gs-n">{{ $pendingDocs }}</div>
                        <div class="gs-l">Pending Docs</div>
                    </div>
                    <div class="gs">
                        <div class="gs-n">{{ $pendingIssues }}</div>
                        <div class="gs-l">Open Issues</div>
                    </div>
                    <div class="gs">
                        <div class="gs-n">{{ $totalPets }}</div>
                        <div class="gs-l">Pets</div>
                    </div>

                </div>
            </div>

            {{-- GLOBAL SEARCH & FILTERS --}}
            <div class="global-search-bar no-print" style="margin-bottom:16px; position:relative;" @click.away="showGlobalResults=false">
                <div style="display:flex;gap:var(--gap);background:#fff;padding:8px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,52,.04);border:1px solid var(--border);flex-wrap:wrap;">
                    <div style="flex:1;min-width:200px;display:flex;align-items:center;background:#f8fafc;border-radius:8px;padding:0 14px; position:relative;">
                        <i class="fas fa-search" style="color:var(--light);"></i>
                        <input type="text" x-model="globalSearchInput" @keydown.enter="performGlobalSearch" @input.debounce.300ms="if(globalSearchInput.length > 2) performGlobalSearch()" @focus="if(globalSearchInput) performGlobalSearch()" placeholder="Search here" style="width:100%;background:transparent;border:none;outline:none;padding:10px 12px;font-family:inherit;font-size:12px;font-weight:600;color:var(--text);">
                        <button x-show="globalSearchInput" @click="globalSearchInput='';showGlobalResults=false;searchOff='';searchAnn='';searchEvt=''" style="background:none;border:none;color:var(--light);cursor:pointer;padding:4px;"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <div style="display:flex;gap:10px;position:relative;">
                        <button class="btn" @click.stop="showFilters=!showFilters" style="background:#f1f5f9;color:var(--muted);font-weight:700;padding:0 16px;border-radius:8px;font-size:11px;white-space:nowrap;"><i class="fas fa-sliders-h"></i> Filters</button>
                        <div x-show="showFilters" @click.away="showFilters=false" x-cloak x-transition style="position:absolute;top:100%;right:0;margin-top:8px;background:#fff;border-radius:12px;box-shadow:0 10px 40px rgba(0,0,52,.1);border:1px solid var(--border);z-index:110;min-width:220px;padding:16px;">
                            <div style="font-size:11px;font-weight:900;color:var(--text);letter-spacing:.05em;text-transform:uppercase;margin-bottom:12px;">Filter Residents</div>
                            <div style="font-size:10px;font-weight:700;color:var(--muted);margin-bottom:6px;">BIRTH MONTH</div>
                            <select x-model="filterMonth" @change="applyFilters()" style="width:100%;padding:10px;border-radius:8px;border:1px solid var(--border);font-family:inherit;font-size:12px;font-weight:600;color:var(--text);outline:none;cursor:pointer;background:#f8fafc;">
                                <option value="">Select Month...</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Global Search Results Dropdown --}}
                <div x-show="showGlobalResults" x-cloak class="search-dropdown" x-transition style="position:absolute;top:100%;left:0;right:0;margin-top:8px;background:#fff;border-radius:12px;box-shadow:0 10px 40px rgba(0,0,52,.1);border:1px solid var(--border);z-index:100;max-height:400px;overflow-y:auto;padding:12px;">
                    <template x-if="globalSearchResults.length === 0">
                        <div style="padding:20px;text-align:center;color:var(--muted);font-size:12px;font-weight:600;"><i class="fas fa-search" style="opacity:.2;font-size:24px;display:block;margin-bottom:8px;"></i>No matching results found for "<span x-text="globalSearchInput"></span>".</div>
                    </template>
                    <template x-for="res in globalSearchResults" :key="res.type + res.id">
                        <div @click="goToResult(res)" style="padding:10px 14px;border-bottom:1px solid #f8fafc;cursor:pointer;display:flex;align-items:center;gap:12px;border-radius:8px;transition:background .2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                            <div style="width:36px;height:36px;border-radius:8px;background:#eff6ff;color:#0E5393;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i :class="res.icon"></i>
                            </div>
                            <div style="flex:1;">
                                <div style="font-size:13px;font-weight:800;color:var(--text);" x-text="res.title"></div>
                                <div style="font-size:10px;font-weight:600;color:var(--light);" x-text="res.subtitle"></div>
                            </div>
                            <span style="font-size:9px;font-weight:800;background:#f8fafc;color:var(--muted);padding:3px 8px;border-radius:99px;text-transform:uppercase;border:1px solid var(--border);" x-text="res.type"></span>
                        </div>
                    </template>
                </div>
            </div>

            {{-- TABS --}}
            <div class="tab-bar no-print">
                <button class="tab-btn" :class="tab==='overview'?'active':''" @click="tab='overview'">
                    <i class="fas fa-chart-pie"></i> <span>Overview</span>
                </button>
                <button class="tab-btn" :class="tab==='demographics'?'active':''" @click="tab='demographics'">
                    <i class="fas fa-users"></i> <span>Demographics</span>
                    <span class="tcnt">{{ $totalResidents }}</span>
                </button>
                <button class="tab-btn" :class="tab==='officials'?'active':''" @click="tab='officials'">
                    <i class="fas fa-user-tie"></i> <span>Officials</span>
                    <span class="tcnt">{{ $officials->count() }}</span>
                </button>
                <button class="tab-btn" :class="tab==='announcements'?'active':''" @click="tab='announcements'">
                    <i class="fas fa-bullhorn"></i> <span>News & Events</span>
                    <span class="tcnt">{{ $announcements->count() + $events->count() }}</span>
                </button>


                <button class="tab-btn" :class="tab==='reports'?'active':''" @click="tab='reports'">
                    <i class="fas fa-file-alt"></i> <span>Reports</span>
                </button>
                <button class="tab-btn" :class="tab==='website'?'active':''" @click="tab='website'">
                    <i class="fas fa-globe"></i> <span>Website</span>
                </button>
                <button class="tab-btn" :class="tab==='system'?'active':''" @click="tab='system'">
                    <i class="fas fa-cogs"></i> <span>System</span>
                </button>
            </div>

            {{-- ══ OVERVIEW ══ --}}
            <div x-show="tab==='overview'" x-transition>
                <div class="sg">
                    <button type="button" class="sc" @click="openResidentModal('all', 'Total Residents Masterlist')" style="cursor:pointer; text-align:left; border:none; width:100%;" title="Click to view resident list">
                        <div class="sc-ico" style="background:#eff6ff;"><i class="fas fa-users"
                                style="color:#0E5393;"></i></div>
                        <div>
                            <div class="sc-n">{{ $totalResidents }}</div>
                            <div class="sc-l">Total Residents</div>
                            <div style="font-size:8px; color:var(--muted); font-weight:600; margin-top:2px;">
                                {{ $voters }} Voters • {{ $seniors }} Seniors • {{ $pwds }} PWDs
                            </div>
                        </div>
                    </button>
                    <button type="button" class="sc" @click="openDocsModal()" style="cursor:pointer; text-align:left; border:none; width:100%;" title="Click to view pending documents">
                        <div class="sc-ico" style="background:#dcfce7;"><i class="fas fa-file-alt"
                                style="color:#15803d;"></i></div>
                        <div>
                            <div class="sc-n">{{ $totalDocs }}</div>
                            <div class="sc-l">Document Requests</div>
                            <div style="font-size:8px; color:var(--muted); font-weight:600; margin-top:2px;">
                                {{ $pendingDocs }} Pending • {{ $readyDocs }} Ready
                            </div>
                        </div>
                    </button>
                    <button type="button" class="sc" @click="openIssuesModal()" style="cursor:pointer; text-align:left; border:none; width:100%;" title="Click to view issue reports">
                        <div class="sc-ico" style="background:#fef3c7;"><i class="fas fa-flag"
                                style="color:#a16207;"></i></div>
                        <div>
                            <div class="sc-n">{{ $totalIssues }}</div>
                            <div class="sc-l">Issue Reports</div>
                            <div style="font-size:8px; color:var(--muted); font-weight:600; margin-top:2px;">
                                {{ $vawcIssues }} VAWC • {{ $peaceIssues }} Peace • {{ $justiceIssues }} Justice
                            </div>
                        </div>
                    </button>
                    <button type="button" class="sc" @click="openPetsModal()" style="cursor:pointer; text-align:left; border:none; width:100%;" title="Click to view pet registry">
                        <div class="sc-ico" style="background:#fce7f3;"><i class="fas fa-paw"
                                style="color:#be185d;"></i></div>
                        <div>
                            <div class="sc-n">{{ $totalPets }}</div>
                            <div class="sc-l">Registered Pets</div>
                            <div style="font-size:8px; color:var(--muted); font-weight:600; margin-top:2px;">
                                {{ $vaccinated }} Vaccinated • {{ $unvaccinated }} Unvax
                            </div>
                        </div>
                    </button>
                    <button type="button" class="sc" @click="openHouseholdModal()" style="cursor:pointer; text-align:left; border:none; width:100%;" title="Click to view household heads">
                        <div class="sc-ico" style="background:#e0f2fe;"><i class="fas fa-home"
                                style="color:#0369a1;"></i></div>
                        <div>
                            <div class="sc-n">{{ $totalHouseholds }}</div>
                            <div class="sc-l">Total Households</div>
                            <div style="font-size:8px; color:var(--muted); font-weight:600; margin-top:2px;">
                                Registered Families
                            </div>
                        </div>
                    </button>
                </div>
                <div class="chart-grid">
                    <div class="chart-box">
                        <div class="chart-title"><i class="fas fa-file-invoice"></i> Document Requests</div>
                        <div style="position:relative;height:220px;width:100%;"><canvas id="docChart"></canvas></div>
                    </div>
                    <div class="chart-box">
                        <div class="chart-title"><i class="fas fa-flag"></i> Issues by Department</div>
                        <div style="position:relative;height:220px;width:100%;"><canvas id="issueChart"></canvas></div>
                    </div>
                </div>
                <div class="chart-grid">
                    <div class="chart-box">
                        <div class="chart-title"><i class="fas fa-paw"></i> Pet Vaccination Status</div>
                        <div style="position:relative;height:220px;width:100%;"><canvas id="petChart"></canvas></div>
                    </div>
                    <div class="chart-box">
                        <div class="chart-title"><i class="fas fa-venus-mars"></i> Gender Distribution</div>
                        <div style="position:relative;height:220px;width:100%;"><canvas id="genderChart"></canvas></div>
                    </div>
                </div>
            </div>

            {{-- ══ DEMOGRAPHICS ══ --}}
            <div x-show="tab==='demographics'" x-transition>
                <div class="sg" style="margin-bottom:20px;">
                    <button type="button" class="sc" @click="openResidentModal('all', 'Total Residents Masterlist')" style="cursor:pointer; text-align:left; border:none; width:100%;" title="Click to view all residents">
                        <div class="sc-ico" style="background:#eff6ff;"><i class="fas fa-users"
                                style="color:#0E5393;"></i></div>
                        <div>
                            <div class="sc-n">{{ $totalResidents }}</div>
                            <div class="sc-l">Total Residents</div>
                        </div>
                    </button>
                    <button type="button" class="sc" @click="openResidentModal('voter', 'Registered Voters List')" style="cursor:pointer; text-align:left; border:none; width:100%;" title="Click to view registered voters">
                        <div class="sc-ico" style="background:#dbeafe;"><i class="fas fa-vote-yea"
                                style="color:#1d4ed8;"></i></div>
                        <div>
                            <div class="sc-n">{{ $voters }}</div>
                            <div class="sc-l">Registered Voters</div>
                        </div>
                    </button>
                    <button type="button" class="sc" @click="openResidentModal('birthday', 'Birthday Celebrants (This Month)')" style="cursor:pointer; text-align:left; border:none; width:100%;" title="Click to view birthday celebrants">
                        <div class="sc-ico" style="background:#fef3c7;"><i class="fas fa-birthday-cake"
                                style="color:#a16207;"></i></div>
                        <div>
                            <div class="sc-n">{{ $birthdayThisMonth }}</div>
                            <div class="sc-l">Birthday This Month</div>
                        </div>
                    </button>
                    <button type="button" class="sc" @click="openResidentModal('pending', 'Pending Verification / Non-Voters')" style="cursor:pointer; text-align:left; border:none; width:100%;" title="Click to view pending verification or non-voters">
                        <div class="sc-ico" style="background:#fce7f3;"><i class="fas fa-user-clock"
                                style="color:#be185d;"></i></div>
                        <div>
                            <div class="sc-n">{{ $nonVoters ?? ($totalResidents - $voters) }}</div>
                            <div class="sc-l">Verification Pending</div>
                        </div>
                    </button>
                    <button type="button" class="sc" @click="openHouseholdModal()" style="cursor:pointer; text-align:left; border:none; width:100%;" title="Click to view household list">
                        <div class="sc-ico" style="background:#f0fdf4;"><i class="fas fa-home"
                                style="color:#16a34a;"></i></div>
                        <div>
                            <div class="sc-n">{{ $totalHouseholds }}</div>
                            <div class="sc-l">Total Households</div>
                        </div>
                    </button>
                </div>
                @php
                    $dp = fn($n) => $totalResidents > 0 ? round(($n / $totalResidents) * 100) : 0;
                    $demos = [
                        ['Senior Citizens', 'fa-user-clock', $seniors, '#0E5393', '#eff6ff', 'linear-gradient(90deg,#0E5393,#3b82f6)', 'senior'],
                        ['PWD', 'fa-wheelchair', $pwds, '#0E5393', '#eff6ff', 'linear-gradient(90deg,#0E5393,#3b82f6)', 'pwd'],
                        ['Bed-ridden', 'fa-bed', $bedridden, '#dc2626', 'rgba(220,38,38,0.1)', 'linear-gradient(90deg,#dc2626,#f87171)', 'bedridden'],
                        ['Solo Parents', 'fa-heart', $soloParents, '#0E5393', '#eff6ff', 'linear-gradient(90deg,#0E5393,#3b82f6)', 'solo_parent'],
                        ['Students', 'fa-graduation-cap', $students, '#0E5393', '#eff6ff', 'linear-gradient(90deg,#0E5393,#3b82f6)', 'student'],
                        ['Minors (Under 18)', 'fa-child', $minors, '#0E5393', '#eff6ff', 'linear-gradient(90deg,#0E5393,#3b82f6)', 'minor'],
                        ['Adults (18–59)', 'fa-user', $adults, '#0E5393', '#eff6ff', 'linear-gradient(90deg,#0E5393,#3b82f6)', 'adult'],
                        ['Registered Voters', 'fa-vote-yea', $voters, '#0E5393', '#eff6ff', 'linear-gradient(90deg,#0E5393,#3b82f6)', 'voter'],
                        ['With Accounts', 'fa-user-check', $totalUsers, '#0E5393', '#eff6ff', 'linear-gradient(90deg,#0E5393,#3b82f6)', 'with_account'],
                    ];
                @endphp
                <div class="demo-grid">
                    @foreach($demos as $d)
                        @php $pct = $dp($d[2]); @endphp
                        <div class="dmcard" style="cursor: pointer; transition: transform 0.15s ease, box-shadow 0.15s ease;"
                             @click.stop="openResidentModal('{{ $d[6] }}', '{{ $d[0] }} List')"
                             title="Click to view {{ $d[0] }}"
                             onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                            <div class="dm-top">
                                <div class="dm-ico" style="background:{{ $d[4] }};"><i class="fas {{ $d[1] }}"
                                        style="color:{{ $d[3] }};"></i></div>
                                <div class="dm-n">{{ $d[2] }}</div>
                            </div>
                            <div class="dm-l">{{ $d[0] }}</div>
                            <div class="bar-bg">
                                <div class="bar-fill" style="width:{{ $pct }}%;background:{{ $d[5] }};"></div>
                            </div>
                            <div class="bar-pct">{{ $pct }}% of total</div>
                        </div>
                    @endforeach
                </div>
                <div class="chart-box" style="margin-bottom:18px;">
                    <div class="chart-title"><i class="fas fa-chart-bar"></i> Classifications Overview</div>
                    <div style="position:relative;height:260px;width:100%;"><canvas id="demoChart"></canvas></div>
                </div>
                @php $mPct = $totalResidents > 0 ? round(($male / $totalResidents) * 100) : 50;
                $fPct = 100 - $mPct; @endphp
                <div class="gender-wrap">
                    <div class="chart-title"><i class="fas fa-venus-mars"></i> Gender Distribution</div>
                    <p style="font-size:10px;color:var(--muted);font-weight:600;margin-bottom:2px;">Based on
                        {{ $totalResidents }} registered residents</p>
                    <div class="gbar">
                        <div class="gbar-m" style="width:{{ $mPct }}%;">{{ $mPct > 8 ? $mPct . '%' : '' }}</div>
                        <div class="gbar-f" style="width:{{ $fPct }}%;">{{ $fPct > 8 ? $fPct . '%' : '' }}</div>
                    </div>
                    <div class="glegend">
                        <div class="gl">
                            <div class="gldot" style="background:#0E5393;"></div> Male — <strong
                                style="color:var(--text);margin-left:3px;">{{ $male }}</strong> &nbsp;({{ $mPct }}%)
                        </div>
                        <div class="gl">
                            <div class="gldot" style="background:#ec4899;"></div> Female — <strong
                                style="color:var(--text);margin-left:3px;">{{ $female }}</strong> &nbsp;({{ $fPct }}%)
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══ OFFICIALS ══ --}}
            <div x-show="tab==='officials'" x-transition>
                <div
                    style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:12px;">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <select x-model="filterDept" class="finput" style="width:140px;padding:7px 12px;font-size:11px;">
                            <option value="">All Officials</option>
                            <option value="Peace">Peace</option>
                            <option value="VAWC">VAWC</option>
                            <option value="Justice">Justice</option>
                            <option value="Office">Office</option>
                        </select>
                        <input type="text" x-model="searchOff" placeholder="Search official..." class="finput"
                            style="width:220px;padding:7px 12px;font-size:11px;">
                        <button @click="offViewMode='grid'" class="btn btn-sm"
                            :class="offViewMode==='grid'?'btn-primary':'btn-ghost'"><i
                                class="fas fa-th-large"></i></button>
                        <button @click="offViewMode='list'" class="btn btn-sm"
                            :class="offViewMode==='list'?'btn-primary':'btn-ghost'"><i class="fas fa-list"></i></button>
                    </div>
                    <button @click="addOffModal=true;photoPreview=null" class="btn btn-primary"><i
                            class="fas fa-user-plus"></i> Add Official</button>
                </div>
                <div class="card" style="margin-bottom:18px;">
                    <div class="card-head">
                        <div class="card-title"><i class="fas fa-user-tie"></i> Current Officials</div>
                        <span class="cbadge">{{ $officials->count() }} Active</span>
                    </div>
                    @if($officials->isEmpty())
                        <div class="empty-st"><i class="fas fa-user-tie"></i>
                            <p>No officials yet. Add one from the button above.</p>
                        </div>
                    @else
                        <div :class="offViewMode==='grid'?'off-grid':''" style="padding-bottom:16px;">
                            @foreach($officials as $off)
                                <div :class="offViewMode==='grid'?'off-card':''"
                                    x-show="'{{ strtolower(addslashes($off->name . ' ' . $off->position)) }}'.includes(searchOff.toLowerCase()) && (filterDept === '' || '{{ $off->department }}' === filterDept)"
                                    :style="offViewMode==='list'?'display:flex;align-items:center;gap:14px;background:#f8fafc;border:1px solid var(--border);border-radius:12px;padding:12px;margin:0 16px 10px;text-align:left;':''">
                                    <div class="off-photo-wrap"
                                        :style="offViewMode==='list'?'width:44px;height:44px;margin:0;flex-shrink:0;':''">
                                        <img src="{{ $off->photo ? asset('storage/' . $off->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($off->name) . '&background=0E5393&color=fff&size=128&bold=true' }}"
                                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($off->name) }}&background=0E5393&color=fff&size=128&bold=true';"
                                             class="off-photo">
                                    </div>
                                    <div :style="offViewMode==='list'?'flex:1;':''">
                                        <div class="off-name">{{ $off->name }}</div>
                                        <div class="off-pos">{{ $off->position }}</div>
                                        @if($off->term_start)
                                            <div class="off-term">
                                                {{ \Carbon\Carbon::parse($off->term_start)->format('M Y') }}@if($off->term_end) –
                                        {{ \Carbon\Carbon::parse($off->term_end)->format('M Y') }}@endif</div>@endif
                                    </div>
                                    <div class="off-acts" :style="offViewMode==='list'?'margin-top:0;justify-content:flex-end;':''">
                                        <div x-data="{ editModal: false, photoPreview: '{{ $off->photo ? asset('storage/' . $off->photo) : '' }}' }">
                                            <button @click="editModal=true" class="btn btn-sm btn-edit"><i class="fas fa-edit"></i> Edit</button>
                                            
                                            {{-- Individual Edit Modal --}}
                                            <div x-show="editModal" x-cloak class="modal-ov" x-transition style="text-align:left;z-index:9999;">
                                                <div class="modal-box" @click.away="editModal=false" style="margin: 20px auto;">
                                                    <div class="modal-in">
                                                        <div class="modal-hd">
                                                            <div class="modal-ttl">
                                                                <div class="mico"><i class="fas fa-user-edit"></i></div> Edit Official
                                                            </div><button @click="editModal=false" class="mclose"><i
                                                                    class="fas fa-times-circle"></i></button>
                                                        </div>
                                                        <form action="{{ route('admin.officials.update', $off->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf @method('PUT')
                                                            <div class="fgrp"><label class="flbl">Official Photo</label>
                                                                <label style="cursor:pointer;display:block;">
                                                                    <div style="height:150px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;transition:all .2s;" :style="photoPreview?'border:2px solid #0E5393':''">
                                                                        <img x-show="photoPreview" :src="photoPreview" style="width:100%;height:100%;object-fit:contain;">
                                                                        <div x-show="!photoPreview" style="text-align:center;"><i class="fas fa-image" style="font-size:24px;color:var(--light);margin-bottom:6px;"></i><div style="font-size:11px;font-weight:800;color:var(--muted);text-transform:uppercase;">Change Photo</div></div>
                                                                    </div>
                                                                    <input type="file" name="photo" accept="image/*" style="display:none;" @change="const f=$event.target.files[0];if(f){const r=new FileReader();r.onload=e=>photoPreview=e.target.result;r.readAsDataURL(f)}">
                                                                </label>
                                                            </div>
                                                            <div class="fgrid2 fgrp">
                                                                <div><label class="flbl">Full Name *</label><input type="text" name="name" required
                                                                        class="finput" value="{{ $off->name }}"></div>
                                                                <div><label class="flbl">Position *</label><input type="text" name="position"
                                                                        class="finput" value="{{ $off->position }}" required></div>
                                                            </div>
                                                            <div class="fgrp">
                                                                <label class="flbl">Department *</label>
                                                                <select name="department" class="finput" required>
                                                                    <option value="" {{ $off->department == '' ? 'selected' : '' }}>None</option>
                                                                    <option value="Peace" {{ $off->department == 'Peace' ? 'selected' : '' }}>Peace</option>
                                                                    <option value="VAWC" {{ $off->department == 'VAWC' ? 'selected' : '' }}>VAWC</option>
                                                                    <option value="Justice" {{ $off->department == 'Justice' ? 'selected' : '' }}>Justice</option>
                                                                    <option value="Office" {{ $off->department == 'Office' ? 'selected' : '' }}>Office</option>
                                                                    <option value="Admin" {{ $off->department == 'Admin' ? 'selected' : '' }}>Admin</option>
                                                                </select>
                                                            </div>
                                                            <div class="fgrid2 fgrp">
                                                                <div><label class="flbl">Term Start</label><input type="date" name="term_start"
                                                                        class="finput" value="{{ $off->term_start }}"></div>
                                                                <div><label class="flbl">Term End</label><input type="date" name="term_end"
                                                                        class="finput" value="{{ $off->term_end }}"></div>
                                                            </div>
                                                            <div style="display:flex;justify-content:flex-end;gap:9px;"><button type="button"
                                                                    @click="editModal=false" class="btn btn-ghost">Cancel</button><button type="submit"
                                                                    class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button></div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form action="{{ route('admin.officials.archive', $off->id) }}" method="POST"
                                            @submit.prevent="triggerConfirm('Archive Official', 'Are you sure you want to archive {{ addslashes($off->name) }}?', () => $el.submit())">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-warn"><i class="fas fa-archive"></i>
                                                Archive</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                @if($archivedOfficials->isNotEmpty())
                    <div class="card">
                        <div class="card-head">
                            <div class="card-title" style="color:var(--muted);"><i class="fas fa-archive"
                                    style="color:var(--light);"></i> Archived Officials</div>
                            <span class="cbadge"
                                style="background:#f1f5f9;color:#64748b;">{{ $archivedOfficials->count() }}</span>
                        </div>
                        <div style="overflow-x:auto;">
                            <table style="width:100%;border-collapse:collapse;">
                                <thead>
                                    <tr style="background:#f8fafc;">
                                        <th
                                            style="padding:11px 14px;font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;text-align:left;border-bottom:1px solid var(--border);">
                                            Official</th>
                                        <th
                                            style="padding:11px 14px;font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;text-align:left;border-bottom:1px solid var(--border);">
                                            Position</th>
                                        <th
                                            style="padding:11px 14px;font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;text-align:right;border-bottom:1px solid var(--border);">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($archivedOfficials as $off)
                                        <tr style="border-bottom:1px solid #f8fafc;">
                                            <td style="padding:11px 14px;">
                                                <div style="display:flex;align-items:center;gap:10px;">
                                                    <img src="{{ $off->photo ? asset('storage/' . $off->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($off->name) . '&background=94a3b8&color=fff&size=64&bold=true' }}"
                                                         onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($off->name) }}&background=94a3b8&color=fff&size=64&bold=true';"
                                                         style="width:32px;height:32px;border-radius:8px;object-fit:cover;">
                                                    <div style="font-size:12px;font-weight:800;color:var(--muted);">
                                                        {{ $off->name }}</div>
                                                </div>
                                            </td>
                                            <td style="padding:11px 14px;font-size:11px;color:var(--muted);">
                                                {{ $off->position }}</td>
                                            <td style="padding:11px 14px;text-align:right;">
                                                <div style="display:flex;gap:5px;justify-content:flex-end;">
                                                    <form action="{{ route('admin.officials.restore', $off->id) }}" method="POST">
                                                        @csrf @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-undo"></i> Restore</button>
                                                    </form>
                                                    <form action="{{ route('admin.officials.destroy', $off->id) }}" method="POST" @submit.prevent="triggerConfirm('Delete Official', 'Permanently delete this official? This cannot be undone.', () => $el.submit())">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-warn" style="background:#ef4444;border-color:#ef4444;color:white;"><i class="fas fa-trash"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>

            {{-- ══ NEWS & EVENTS ══ --}}
            <div x-show="tab==='announcements'" x-transition>
                <div class="no-print" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:12px;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <i class="fas fa-search" style="color:var(--light); font-size: 14px;"></i>
                        <input type="text" x-model="searchAnn" @input="searchEvt = searchAnn; searchProj = searchAnn" placeholder="Search news, events & projects..." class="finput"
                            style="width:300px;padding:7px 12px;font-size:11px;">
                    </div>
                    <div style="display:flex;gap:8px;">
                        <button @click="addProjModal=true" class="btn btn-primary" style="background:linear-gradient(135deg,#0E5393,#04192D);box-shadow:0 4px 12px rgba(14,83,147,0.3);"><i class="fas fa-hammer"></i> New Project</button>
                        <button @click="addEvtModal=true;evtPhotoPreview=null" class="btn btn-primary"><i class="fas fa-calendar-plus"></i> New Event</button>
                        <button @click="addAnnModal=true;annPhotoPreview=null" class="btn btn-primary"><i class="fas fa-bullhorn"></i> New Announcement</button>
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(450px, 1fr));gap:var(--gap);align-items:start;">
                    
                    {{-- LEFT COLUMN: EVENTS --}}
                    <div>
                        <div class="card" style="margin-bottom:18px;">
                            <div class="card-head">
                                <div class="card-title"><i class="fas fa-calendar-alt"></i> Active Events & Schedules</div>
                                <span class="cbadge">{{ $events->count() }}</span>
                            </div>
                            @if($events->isEmpty())
                                <div class="empty-st"><i class="fas fa-calendar-alt"></i><p>No active events.</p></div>
                            @else
                                @foreach($events as $evt)
                                    <div class="evt-item" x-show="'{{ strtolower(addslashes($evt->title . ' ' . $evt->location . ' ' . $evt->description)) }}'.includes(searchEvt.toLowerCase())">
                                        <div class="evt-day">
                                            <div class="evt-day-num">{{ $evt->day_label }}</div>
                                            <div class="evt-day-sm">{{ $evt->frequency }}</div>
                                        </div>
                                        @if($evt->image_path)
                                            <div style="width:50px;height:50px;border-radius:10px;overflow:hidden;flex-shrink:0;border:1px solid var(--border);position:relative;">
                                                <img src="{{ asset('storage/' . $evt->image_path) }}" 
                                                     onerror="this.onerror=null; this.src='{{ asset('images/cleanup.jpg') }}';"
                                                     style="width:100%;height:100%;object-fit:cover;">
                                                @if(count($evt->images_list) > 1)
                                                    <span style="position:absolute;bottom:2px;right:2px;background:rgba(0,0,0,0.7);color:#fff;font-size:8px;font-weight:900;padding:1px 3px;border-radius:3px;">+{{ count($evt->images_list) }}</span>
                                                @endif
                                            </div>
                                        @endif
                                        <div style="flex:1;min-width:0;">
                                            @php $etColors = ['Community' => ['#dcfce7', '#15803d'], 'Health' => ['#dbeafe', '#1d4ed8'], 'Sanitation' => ['#ffedd5', '#ea580c'], 'Governance' => ['#ede9fe', '#7c3aed']];
                                            $etc = $etColors[$evt->tag] ?? ['#f1f5f9', '#475569']; @endphp
                                            <div style="font-size:13px;font-weight:800;color:var(--text);">{{ $evt->title }}</div>
                                            <div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:2px;line-height:1.4;">
                                                @if($evt->time_range){{ $evt->time_range }}@endif @if($evt->location) • {{ $evt->location }}@endif
                                            </div>
                                            @if($evt->description)
                                                <div style="font-size:10px;color:var(--light);font-weight:600;margin-top:2px;">{{ $evt->description }}</div>
                                            @endif
                                            <div style="display:flex;align-items:center;gap:6px;margin-top:4px;">
                                                <span style="font-size:8px;font-weight:900;background:{{ $etc[0] }};color:{{ $etc[1] }};padding:2px 8px;border-radius:99px;display:inline-block;">{{ $evt->tag }}</span>
                                                @if(count($evt->images_list) > 1)
                                                    <span style="font-size:8px;font-weight:900;background:rgba(14,83,147,0.1);color:var(--brand);padding:2px 6px;border-radius:99px;display:inline-flex;align-items:center;gap:3px;">
                                                        <i class="fas fa-images"></i> {{ count($evt->images_list) }} photos
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="ann-actions">
                                            <div x-data="{ editModal: false }">
                                                <button @click="editModal=true" class="btn btn-sm btn-edit"><i class="fas fa-edit"></i></button>
                                                
                                                {{-- Individual Event Edit Modal --}}
                                                <div x-show="editModal" x-cloak class="modal-ov" x-transition style="text-align:left;z-index:9999;">
                                                    <div class="modal-box" @click.away="editModal=false" style="margin: 20px auto;max-width:560px;">
                                                        <div class="modal-in">
                                                            <div class="modal-hd">
                                                                <div class="modal-ttl">
                                                                    <div class="mico"><i class="fas fa-calendar-edit"></i></div> Edit Event
                                                                </div><button @click="editModal=false" class="mclose"><i
                                                                        class="fas fa-times-circle"></i></button>
                                                            </div>
                                                            <form action="{{ route('admin.events.update', $evt->id) }}" method="POST" enctype="multipart/form-data"
                                                                x-data="makePhotoUploader({{ json_encode($evt->images_list) }})">
                                                                @csrf @method('PUT')
                                                                <div class="fgrp"><label class="flbl">Event Title *</label><input type="text" name="title"
                                                                        required class="finput" value="{{ $evt->title }}"></div>
                                                                <div class="fgrp">
                                                                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                                                                        <label class="flbl" style="margin-bottom:0;">Photos <span style="font-size:9px;color:var(--brand);font-weight:800;">(Max 6 Photos)</span></label>
                                                                        <span style="font-size:10px;font-weight:800;" :style="photos.length >= 6 ? 'color:var(--danger)' : 'color:var(--muted)'" x-text="photos.length + ' / 6 photos' + (photos.length >= 6 ? ' (Max)' : '')"></span>
                                                                    </div>
                                                                    
                                                                    <div style="min-height:95px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);padding:10px;transition:all .2s;"
                                                                         @dragover.prevent="$el.style.border='2px solid #0E5393';$el.style.background='#eff6ff'"
                                                                         @dragleave.prevent="$el.style.border='2px dashed var(--border)';$el.style.background='#f8fafc'"
                                                                         @drop.prevent="$el.style.border='2px dashed var(--border)';$el.style.background='#f8fafc';addFiles($event.dataTransfer.files)">
                                                                        
                                                                        <input type="file" name="images[]" multiple accept="image/*" style="display:none;" x-ref="fileInput" @change="addFiles($event.target.files)">
                                                                        
                                                                        <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(75px, 1fr));gap:8px;width:100%;">
                                                                            <template x-for="(p, idx) in photos" :key="idx">
                                                                                <div style="position:relative;height:75px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border);background:#fff;box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                                                                                    <img :src="p.url" style="width:100%;height:100%;object-fit:cover;">
                                                                                    <span style="position:absolute;bottom:2px;left:2px;background:rgba(0,0,0,0.65);color:#fff;font-size:8px;font-weight:900;padding:1px 4px;border-radius:3px;" x-text="'#' + (idx+1)"></span>
                                                                                    <button type="button" @click.stop="removePhoto(idx)" title="Remove Photo"
                                                                                            style="position:absolute;top:3px;right:3px;width:18px;height:18px;border-radius:50%;background:rgba(220,38,38,0.9);color:#fff;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:9px;line-height:1;box-shadow:0 1px 3px rgba(0,0,0,0.3);transition:.15s;"
                                                                                            onmouseover="this.style.transform='scale(1.15)';this.style.background='#dc2626'"
                                                                                            onmouseout="this.style.transform='scale(1)';this.style.background='rgba(220,38,38,0.9)'">
                                                                                        <i class="fas fa-times"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </template>

                                                                            <template x-if="photos.length < 6">
                                                                                <div @click="$refs.fileInput.click()"
                                                                                     style="height:75px;border-radius:8px;background:#f8fafc;border:2px dashed #0E5393;display:flex;flex-direction:column;align-items:center;justify-content:center;cursor:pointer;transition:all .18s;gap:3px;user-select:none;"
                                                                                     onmouseover="this.style.background='#eff6ff';this.style.borderColor='#0E5393'"
                                                                                     onmouseout="this.style.background='#f8fafc';this.style.borderColor='#0E5393'">
                                                                                    <div style="width:24px;height:24px;border-radius:50%;background:#0E5393;color:#fff;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:900;">
                                                                                        <i class="fas fa-plus"></i>
                                                                                    </div>
                                                                                    <span style="font-size:8px;font-weight:800;color:#0E5393;text-align:center;line-height:1.1;" x-text="photos.length === 0 ? 'Upload Photo' : '+' + (6 - photos.length) + ' more'"></span>
                                                                                </div>
                                                                            </template>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="fgrid2 fgrp" x-data="{ dayLabel: '{{ $evt->day_label }}' }">
                                                                    <div>
                                                                        <label class="flbl">Day Label</label>
                                                                        <div class="finput" style="background:#f1f5f9;font-weight:900;font-size:15px;color:var(--text);text-align:center;" x-text="dayLabel"></div>
                                                                        <input type="hidden" name="day_label" :value="dayLabel">
                                                                    </div>
                                                                    <div>
                                                                        <label class="flbl">Date *</label>
                                                                        <input type="date" name="frequency" class="finput" value="{{ $evt->frequency }}" required
                                                                            @change="const d=new Date($event.target.value+'T00:00:00');dayLabel=['SUN','MON','TUE','WED','THU','FRI','SAT'][d.getDay()]">
                                                                    </div>
                                                                </div>
                                                                <div class="fgrid2 fgrp">
                                                                    <div><label class="flbl">Time Range</label><input type="text" name="time_range"
                                                                            class="finput" value="{{ $evt->time_range }}"></div>
                                                                    <div><label class="flbl">Location</label><input type="text" name="location" class="finput"
                                                                            value="{{ $evt->location }}"></div>
                                                                </div>
                                                                <div class="fgrp"><label class="flbl">Tag</label><select name="tag" class="finput">
                                                                        <option {{ $evt->tag == 'Community' ? 'selected' : '' }}>Community</option>
                                                                        <option {{ $evt->tag == 'Health' ? 'selected' : '' }}>Health</option>
                                                                        <option {{ $evt->tag == 'Sanitation' ? 'selected' : '' }}>Sanitation</option>
                                                                        <option {{ $evt->tag == 'Governance' ? 'selected' : '' }}>Governance</option>
                                                                    </select></div>
                                                                <div class="fgrp"><label class="flbl">Description</label><textarea name="description" rows="2"
                                                                        class="finput" style="resize:vertical;">{{ $evt->description }}</textarea></div>
                                                                <div style="display:flex;justify-content:flex-end;gap:9px;"><button type="button"
                                                                        @click="editModal=false" class="btn btn-ghost">Cancel</button><button type="submit"
                                                                        class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button></div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('admin.events.archive', $evt->id) }}" method="POST"
                                                @submit.prevent="triggerConfirm('Archive Event', 'Are you sure you want to archive this event?', () => $el.submit())">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-warn"><i class="fas fa-archive"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        
                        @if($archivedEvents->isNotEmpty())
                            <div class="card">
                                <div class="card-head">
                                    <div class="card-title" style="color:var(--muted);"><i class="fas fa-archive"></i> Archived Events</div>
                                    <span class="cbadge" style="background:#f1f5f9;color:#64748b;">{{ $archivedEvents->count() }}</span>
                                </div>
                                @foreach($archivedEvents as $evt)
                                    <div class="evt-item" style="opacity:.6;">
                                        <div style="flex:1;">
                                            <div style="font-size:12px;font-weight:800;color:var(--muted);">{{ $evt->title }}</div>
                                            <div style="font-size:9px;color:var(--light);">Archived {{ $evt->archived_at?->format('M d, Y') }}</div>
                                        </div>
                                        <div style="display:flex;gap:5px;">
                                            <form action="{{ route('admin.events.restore', $evt->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-undo"></i> Restore</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- RIGHT COLUMN: ANNOUNCEMENTS --}}
                    <div>
                        <div class="card" style="margin-bottom:18px;">
                            <div class="card-head">
                                <div class="card-title"><i class="fas fa-bullhorn"></i> Active Announcements</div>
                                <span class="cbadge">{{ $announcements->count() }}</span>
                            </div>
                            @if($announcements->isEmpty())
                                <div class="empty-st"><i class="fas fa-bullhorn"></i><p>No active announcements.</p></div>
                            @else
                                @foreach($announcements as $ann)
                                    <div class="ann-item" x-show="'{{ strtolower(addslashes($ann->title . ' ' . $ann->content)) }}'.includes(searchAnn.toLowerCase())">
                                        @if($ann->image_path)
                                            <div style="width:60px;height:60px;border-radius:10px;overflow:hidden;flex-shrink:0;border:1px solid var(--border);position:relative;">
                                                <img src="{{ asset('storage/' . $ann->image_path) }}" 
                                                     onerror="this.onerror=null; this.src='{{ asset('images/cleanup.jpg') }}';"
                                                     style="width:100%;height:100%;object-fit:cover;">
                                                @if(count($ann->images_list) > 1)
                                                    <span style="position:absolute;bottom:2px;right:2px;background:rgba(0,0,0,0.7);color:#fff;font-size:8px;font-weight:900;padding:1px 4px;border-radius:3px;">+{{ count($ann->images_list) }}</span>
                                                @endif
                                            </div>
                                        @endif
                                        <div style="flex:1;min-width:0;">
                                            @php
                                                $tagColors = ['Announcement' => ['#dbeafe', '#1d4ed8'], 'Health' => ['#dcfce7', '#15803d'], 'Governance' => ['#ede9fe', '#7c3aed'], 'Community' => ['#ffedd5', '#ea580c'], 'Sanitation' => ['#fef3c7', '#a16207']];
                                                $tc = $tagColors[$ann->tag] ?? ['#f1f5f9', '#475569'];
                                            @endphp
                                            <div style="display:flex;align-items:center;gap:6px;">
                                                <span class="ann-tag" style="background:{{ $tc[0] }};color:{{ $tc[1] }};">{{ $ann->tag }}</span>
                                                @if(count($ann->images_list) > 1)
                                                    <span style="font-size:8px;font-weight:900;background:rgba(14,83,147,0.1);color:var(--brand);padding:2px 6px;border-radius:99px;display:inline-flex;align-items:center;gap:3px;">
                                                        <i class="fas fa-images"></i> {{ count($ann->images_list) }} photos
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="ann-title" style="font-size:13px;">{{ $ann->title }}</div>
                                            <div class="ann-body" style="font-size:11px;">{{ \Illuminate\Support\Str::limit($ann->content, 100) }}</div>
                                            <div class="ann-date" style="font-size:9px;"><i class="fas fa-clock" style="margin-right:4px;"></i>{{ $ann->date ? \Carbon\Carbon::parse($ann->date)->format('M d, Y') : $ann->created_at->format('M d, Y') }}</div>
                                        </div>
                                        <div class="ann-actions">
                                            <div x-data="{ editModal: false }">
                                                <button @click="editModal=true" class="btn btn-sm btn-edit"><i class="fas fa-edit"></i></button>
                                                
                                                {{-- Individual Announcement Edit Modal --}}
                                                <div x-show="editModal" x-cloak class="modal-ov" x-transition style="text-align:left;z-index:9999;">
                                                    <div class="modal-box" @click.away="editModal=false" style="margin: 20px auto;max-width:560px;">
                                                        <div class="modal-in">
                                                            <div class="modal-hd">
                                                                <div class="modal-ttl">
                                                                    <div class="mico"><i class="fas fa-bullhorn"></i></div> Edit Announcement
                                                                </div><button @click="editModal=false" class="mclose"><i
                                                                        class="fas fa-times-circle"></i></button>
                                                            </div>
                                                            <form action="{{ route('admin.announcements.update', $ann->id) }}" method="POST" enctype="multipart/form-data"
                                                                  x-data="makePhotoUploader({{ json_encode($ann->images_list) }})">
                                                                @csrf @method('PUT')
                                                                <div class="fgrid2 fgrp">
                                                                    <div><label class="flbl">Title *</label><input type="text" name="title" required
                                                                            class="finput" value="{{ $ann->title }}"></div>
                                                                    <div><label class="flbl">Date</label><input type="date" name="date" class="finput"
                                                                            value="{{ $ann->date }}"></div>
                                                                </div>
                                                                <div class="fgrp">
                                                                    <label class="flbl">Category / Tag</label>
                                                                    <select name="tag" class="finput">
                                                                        <option {{ $ann->tag == 'Announcement' ? 'selected' : '' }}>Announcement</option>
                                                                        <option {{ $ann->tag == 'Health' ? 'selected' : '' }}>Health</option>
                                                                        <option {{ $ann->tag == 'Governance' ? 'selected' : '' }}>Governance</option>
                                                                        <option {{ $ann->tag == 'Community' ? 'selected' : '' }}>Community</option>
                                                                        <option {{ $ann->tag == 'Sanitation' ? 'selected' : '' }}>Sanitation</option>
                                                                    </select>
                                                                </div>
                                                                <div class="fgrp">
                                                                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                                                                        <label class="flbl" style="margin-bottom:0;">Photos <span style="font-size:9px;color:var(--brand);font-weight:800;">(Max 6 Photos)</span></label>
                                                                        <span style="font-size:10px;font-weight:800;" :style="photos.length >= 6 ? 'color:var(--danger)' : 'color:var(--muted)'" x-text="photos.length + ' / 6 photos' + (photos.length >= 6 ? ' (Max)' : '')"></span>
                                                                    </div>
                                                                    
                                                                    <div style="min-height:95px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);padding:10px;transition:all .2s;"
                                                                         @dragover.prevent="$el.style.border='2px solid #0E5393';$el.style.background='#eff6ff'"
                                                                         @dragleave.prevent="$el.style.border='2px dashed var(--border)';$el.style.background='#f8fafc'"
                                                                         @drop.prevent="$el.style.border='2px dashed var(--border)';$el.style.background='#f8fafc';addFiles($event.dataTransfer.files)">
                                                                        
                                                                        <input type="file" name="images[]" multiple accept="image/*" style="display:none;" x-ref="fileInput" @change="addFiles($event.target.files)">
                                                                        
                                                                        <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(75px, 1fr));gap:8px;width:100%;">
                                                                            <template x-for="(p, idx) in photos" :key="idx">
                                                                                <div style="position:relative;height:75px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border);background:#fff;box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                                                                                    <img :src="p.url" style="width:100%;height:100%;object-fit:cover;">
                                                                                    <span style="position:absolute;bottom:2px;left:2px;background:rgba(0,0,0,0.65);color:#fff;font-size:8px;font-weight:900;padding:1px 4px;border-radius:3px;" x-text="'#' + (idx+1)"></span>
                                                                                    <button type="button" @click.stop="removePhoto(idx)" title="Remove Photo"
                                                                                            style="position:absolute;top:3px;right:3px;width:18px;height:18px;border-radius:50%;background:rgba(220,38,38,0.9);color:#fff;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:9px;line-height:1;box-shadow:0 1px 3px rgba(0,0,0,0.3);transition:.15s;"
                                                                                            onmouseover="this.style.transform='scale(1.15)';this.style.background='#dc2626'"
                                                                                            onmouseout="this.style.transform='scale(1)';this.style.background='rgba(220,38,38,0.9)'">
                                                                                        <i class="fas fa-times"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </template>

                                                                            <template x-if="photos.length < 6">
                                                                                <div @click="$refs.fileInput.click()"
                                                                                     style="height:75px;border-radius:8px;background:#f8fafc;border:2px dashed #0E5393;display:flex;flex-direction:column;align-items:center;justify-content:center;cursor:pointer;transition:all .18s;gap:3px;user-select:none;"
                                                                                     onmouseover="this.style.background='#eff6ff';this.style.borderColor='#0E5393'"
                                                                                     onmouseout="this.style.background='#f8fafc';this.style.borderColor='#0E5393'">
                                                                                    <div style="width:24px;height:24px;border-radius:50%;background:#0E5393;color:#fff;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:900;">
                                                                                        <i class="fas fa-plus"></i>
                                                                                    </div>
                                                                                    <span style="font-size:8px;font-weight:800;color:#0E5393;text-align:center;line-height:1.1;" x-text="photos.length === 0 ? 'Upload Photo' : '+' + (6 - photos.length) + ' more'"></span>
                                                                                </div>
                                                                            </template>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="fgrp"><label class="flbl">Content *</label><textarea name="content" rows="4"
                                                                        required class="finput" style="resize:vertical;">{{ $ann->content }}</textarea></div>
                                                                <div style="display:flex;justify-content:flex-end;gap:9px;"><button type="button"
                                                                        @click="editModal=false" class="btn btn-ghost">Cancel</button><button type="submit"
                                                                        class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button></div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('admin.announcements.archive', $ann->id) }}" method="POST"
                                                @submit.prevent="triggerConfirm('Archive Announcement', 'Are you sure you want to archive this announcement?', () => $el.submit())">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-warn"><i class="fas fa-archive"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        @if($archivedAnnouncements->isNotEmpty())
                            <div class="card">
                                <div class="card-head">
                                    <div class="card-title" style="color:var(--muted);"><i class="fas fa-archive"></i> Archived Announcements</div>
                                    <span class="cbadge" style="background:#f1f5f9;color:#64748b;">{{ $archivedAnnouncements->count() }}</span>
                                </div>
                                @foreach($archivedAnnouncements as $ann)
                                    <div class="ann-item" style="opacity:.6;">
                                        <div style="flex:1;">
                                            <div class="ann-title" style="color:var(--muted);">{{ $ann->title }}</div>
                                            <div class="ann-date">Archived {{ $ann->archived_at?->format('M d, Y') }}</div>
                                        </div>
                                        <div style="display:flex;gap:5px;">
                                            <form action="{{ route('admin.announcements.restore', $ann->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-undo"></i> Restore</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                {{-- FULL ROW: ACTIVE BARANGAY PROJECTS --}}
                <div class="card" style="margin-top:20px;">
                    <div class="card-head">
                        <div class="card-title"><i class="fas fa-hammer"></i> Active Barangay Projects & Transparency</div>
                        <div style="display:flex;align-items:center;gap:8px;">
                            <span class="cbadge" style="background:#0E5393;color:#fff;">{{ $projects->count() }} Projects</span>
                            <button @click="addProjModal=true" class="btn btn-sm btn-primary" style="font-size:10px;padding:4px 10px;"><i class="fas fa-plus"></i> Add Project</button>
                        </div>
                    </div>
                    @if($projects->isEmpty())
                        <div class="empty-st"><i class="fas fa-project-diagram"></i><p>No active projects posted. Click "New Project" to add one.</p></div>
                    @else
                        <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(340px, 1fr));gap:14px;padding:14px;">
                            @foreach($projects as $proj)
                                @php
                                    $pStatBadges = [
                                        'planning'    => ['bg'=>'#e0e7ff', 'color'=>'#3730a3', 'label'=>'Planning'],
                                        'in_progress' => ['bg'=>'#fef3c7', 'color'=>'#92400e', 'label'=>'In Progress'],
                                        'completed'   => ['bg'=>'#dcfce7', 'color'=>'#166534', 'label'=>'Completed'],
                                    ];
                                    $psb = $pStatBadges[$proj->status] ?? ['bg'=>'#f1f5f9','color'=>'#475569','label'=>ucfirst($proj->status)];
                                @endphp
                                <div class="evt-item" style="border:1px solid var(--border);border-radius:12px;padding:12px;background:#fff;display:flex;flex-direction:column;gap:10px;margin-bottom:0;"
                                     x-show="'{{ strtolower(addslashes($proj->title . ' ' . $proj->category . ' ' . $proj->description . ' ' . $proj->contractor_lead)) }}'.includes(searchProj.toLowerCase())">
                                    
                                    <div style="display:flex;gap:10px;align-items:flex-start;">
                                        @if($proj->image_path || !empty($proj->images_list))
                                            <div style="width:65px;height:65px;border-radius:10px;overflow:hidden;flex-shrink:0;border:1px solid var(--border);position:relative;">
                                                <img src="{{ $proj->cover_image_url }}" style="width:100%;height:100%;object-fit:cover;" onerror="this.onerror=null; this.src='{{ asset('images/canal.jpg') }}';">
                                                @if(count($proj->images_list) > 1)
                                                    <span style="position:absolute;bottom:2px;right:2px;background:rgba(0,0,0,0.75);color:#fff;font-size:8px;font-weight:900;padding:1px 4px;border-radius:3px;">+{{ count($proj->images_list) }}</span>
                                                @endif
                                            </div>
                                        @else
                                            <div style="width:65px;height:65px;border-radius:10px;background:#eff6ff;color:#0E5393;display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0;">
                                                <i class="fas fa-hammer"></i>
                                            </div>
                                        @endif
                                        <div style="flex:1;min-width:0;">
                                            <div style="display:flex;align-items:center;justify-content:space-between;gap:6px;flex-wrap:wrap;">
                                                <span style="font-size:8px;font-weight:900;text-transform:uppercase;padding:2px 8px;border-radius:99px;background:#f1f5f9;color:#475569;">{{ $proj->category ?? 'General' }}</span>
                                                <span style="font-size:8px;font-weight:900;text-transform:uppercase;padding:2px 8px;border-radius:99px;background:{{ $psb['bg'] }};color:{{ $psb['color'] }};">{{ $psb['label'] }}</span>
                                            </div>
                                            <div style="font-size:13px;font-weight:900;color:var(--text);margin-top:4px;line-height:1.3;">{{ $proj->title }}</div>
                                        </div>
                                    </div>

                                    @if($proj->description)
                                        <div style="font-size:10.5px;color:var(--muted);font-weight:600;line-height:1.5;">{{ \Illuminate\Support\Str::limit($proj->description, 100) }}</div>
                                    @endif

                                    <div style="background:#f8fafc;border-radius:8px;padding:8px 10px;font-size:10px;font-weight:700;color:#334155;display:flex;flex-direction:column;gap:3px;">
                                        <div style="display:flex;align-items:center;gap:5px;">
                                            <i class="fas fa-calendar-alt" style="color:var(--brand);font-size:9px;"></i>
                                            <span>Timeline: <strong>{{ $proj->start_date ? \Carbon\Carbon::parse($proj->start_date)->format('M d, Y') : 'TBA' }}</strong> @if($proj->completion_date) – <strong>{{ \Carbon\Carbon::parse($proj->completion_date)->format('M d, Y') }}</strong>@endif</span>
                                        </div>
                                        @if($proj->budget)
                                            <div style="display:flex;align-items:center;gap:5px;">
                                                <i class="fas fa-coins" style="color:#ca8a04;font-size:9px;"></i>
                                                <span>Budget: <strong>₱{{ number_format($proj->budget, 2) }}</strong></span>
                                            </div>
                                        @endif
                                        @if($proj->contractor_lead)
                                            <div style="display:flex;align-items:center;gap:5px;">
                                                <i class="fas fa-hard-hat" style="color:#0284c7;font-size:9px;"></i>
                                                <span>Lead: <strong>{{ $proj->contractor_lead }}</strong></span>
                                            </div>
                                        @endif
                                    </div>

                                    <div style="display:flex;align-items:center;justify-content:space-between;margin-top:auto;padding-top:6px;border-top:1px solid #f1f5f9;">
                                        <span style="font-size:9px;color:var(--light);font-weight:700;">
                                            @if(count($proj->images_list) > 0)
                                                <i class="fas fa-images"></i> {{ count($proj->images_list) }} photo(s)
                                            @endif
                                        </span>
                                        <div style="display:flex;gap:6px;">
                                            {{-- Project Edit Modal Trigger --}}
                                            <div x-data="{ editProjModal: false }">
                                                <button type="button" @click="editProjModal=true" class="btn btn-sm btn-edit" title="Edit Project"><i class="fas fa-edit"></i> Edit</button>
                                                
                                                <div x-show="editProjModal" x-cloak class="modal-ov" x-transition style="text-align:left;z-index:9999;">
                                                    <div class="modal-box" @click.away="editProjModal=false" style="margin:20px auto;max-width:580px;">
                                                        <div class="modal-in">
                                                            <div class="modal-hd">
                                                                <div class="modal-ttl">
                                                                    <div class="mico" style="background:#eff6ff;color:#0E5393;"><i class="fas fa-hammer"></i></div> Edit Project
                                                                </div>
                                                                <button type="button" @click="editProjModal=false" class="mclose"><i class="fas fa-times-circle"></i></button>
                                                            </div>

                                                            <form action="{{ route('admin.projects.update', $proj->id) }}" method="POST" enctype="multipart/form-data"
                                                                  x-data="makePhotoUploader({{ json_encode($proj->images_list) }})">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="fgrp">
                                                                    <label class="flbl">Project Title *</label>
                                                                    <input type="text" name="title" required class="finput" value="{{ $proj->title }}">
                                                                </div>

                                                                {{-- Multi-photo upload --}}
                                                                <div class="fgrp">
                                                                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                                                                        <label class="flbl" style="margin-bottom:0;">Project Photos <span style="font-size:9px;color:var(--brand);font-weight:800;">(Max 6 Photos)</span></label>
                                                                        <span style="font-size:10px;font-weight:800;" :style="photos.length >= 6 ? 'color:var(--danger)' : 'color:var(--muted)'" x-text="photos.length + ' / 6 photos'"></span>
                                                                    </div>
                                                                    <div style="min-height:95px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);padding:10px;">
                                                                        <input type="file" name="images[]" multiple accept="image/*" style="display:none;" x-ref="fileInput" @change="addFiles($event.target.files)">
                                                                        <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(75px, 1fr));gap:8px;width:100%;">
                                                                            <template x-for="(p, idx) in photos" :key="idx">
                                                                                <div style="position:relative;height:75px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border);background:#fff;">
                                                                                    <img :src="p.url" style="width:100%;height:100%;object-fit:cover;" onerror="this.onerror=null; this.src='{{ asset('images/canal.jpg') }}';">
                                                                                    <span style="position:absolute;bottom:2px;left:2px;background:rgba(0,0,0,0.65);color:#fff;font-size:8px;font-weight:900;padding:1px 4px;border-radius:3px;" x-text="'#' + (idx+1)"></span>
                                                                                    <button type="button" @click.stop="removePhoto(idx)"
                                                                                            style="position:absolute;top:3px;right:3px;width:18px;height:18px;border-radius:50%;background:rgba(220,38,38,0.9);color:#fff;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:9px;">
                                                                                        <i class="fas fa-times"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </template>
                                                                            <template x-if="photos.length < 6">
                                                                                <div @click="$refs.fileInput.click()"
                                                                                     style="height:75px;border-radius:8px;background:#f8fafc;border:2px dashed #0E5393;display:flex;flex-direction:column;align-items:center;justify-content:center;cursor:pointer;gap:3px;">
                                                                                    <div style="width:22px;height:22px;border-radius:50%;background:#0E5393;color:#fff;display:flex;align-items:center;justify-content:center;font-size:10px;">
                                                                                        <i class="fas fa-plus"></i>
                                                                                    </div>
                                                                                    <span style="font-size:8px;font-weight:800;color:#0E5393;" x-text="photos.length === 0 ? 'Upload Photo' : '+' + (6 - photos.length) + ' more'"></span>
                                                                                </div>
                                                                            </template>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="fgrid2 fgrp">
                                                                    <div>
                                                                        <label class="flbl">Category</label>
                                                                        <select name="category" class="finput">
                                                                            <option value="Infrastructure" {{ $proj->category == 'Infrastructure' ? 'selected' : '' }}>Infrastructure</option>
                                                                            <option value="Roads & Drainage" {{ $proj->category == 'Roads & Drainage' ? 'selected' : '' }}>Roads & Drainage</option>
                                                                            <option value="Health & Sanitation" {{ $proj->category == 'Health & Sanitation' ? 'selected' : '' }}>Health & Sanitation</option>
                                                                            <option value="Peace & Security" {{ $proj->category == 'Peace & Security' ? 'selected' : '' }}>Peace & Security</option>
                                                                            <option value="Livelihood & Training" {{ $proj->category == 'Livelihood & Training' ? 'selected' : '' }}>Livelihood & Training</option>
                                                                            <option value="Youth & Sports" {{ $proj->category == 'Youth & Sports' ? 'selected' : '' }}>Youth & Sports</option>
                                                                            <option value="Environmental" {{ $proj->category == 'Environmental' ? 'selected' : '' }}>Environmental</option>
                                                                            <option value="General" {{ $proj->category == 'General' ? 'selected' : '' }}>General</option>
                                                                        </select>
                                                                    </div>
                                                                    <div>
                                                                        <label class="flbl">Status *</label>
                                                                        <select name="status" class="finput" required>
                                                                            <option value="planning" {{ $proj->status == 'planning' ? 'selected' : '' }}>Planning</option>
                                                                            <option value="in_progress" {{ $proj->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                                            <option value="completed" {{ $proj->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="fgrid2 fgrp">
                                                                    <div>
                                                                        <label class="flbl">Estimated Start Date</label>
                                                                        <input type="date" name="start_date" class="finput" value="{{ $proj->start_date }}">
                                                                    </div>
                                                                    <div>
                                                                        <label class="flbl">Estimated Completion Date</label>
                                                                        <input type="date" name="completion_date" class="finput" value="{{ $proj->completion_date }}">
                                                                    </div>
                                                                </div>

                                                                <div class="fgrid2 fgrp">
                                                                    <div>
                                                                        <label class="flbl">Allocated Budget (₱)</label>
                                                                        <input type="number" step="0.01" name="budget" class="finput" value="{{ $proj->budget }}" placeholder="e.g. 250000">
                                                                    </div>
                                                                    <div>
                                                                        <label class="flbl">Project Lead / Contractor</label>
                                                                        <input type="text" name="contractor_lead" class="finput" value="{{ $proj->contractor_lead }}" placeholder="e.g. Engr. Dela Cruz / ABC Corp">
                                                                    </div>
                                                                </div>

                                                                <div class="fgrp">
                                                                    <label class="flbl">Project Description & Scope</label>
                                                                    <textarea name="description" rows="3" class="finput" style="resize:vertical;">{{ $proj->description }}</textarea>
                                                                </div>

                                                                <div style="display:flex;justify-content:flex-end;gap:9px;">
                                                                    <button type="button" @click="editProjModal=false" class="btn btn-ghost">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Archive Project Button --}}
                                            <form action="{{ route('admin.projects.archive', $proj->id) }}" method="POST"
                                                  @submit.prevent="triggerConfirm('Archive Project', 'Are you sure you want to archive this project from active display?', () => $el.submit())">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-warn" title="Archive Project"><i class="fas fa-archive"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- ARCHIVED PROJECTS SECTION --}}
                @if($archivedProjects->isNotEmpty())
                    <div class="card" style="margin-top:16px;">
                        <div class="card-head">
                            <div class="card-title" style="color:var(--muted);"><i class="fas fa-archive"></i> Archived Projects</div>
                            <span class="cbadge" style="background:#f1f5f9;color:#64748b;">{{ $archivedProjects->count() }}</span>
                        </div>
                        @foreach($archivedProjects as $proj)
                            <div class="evt-item" style="opacity:.65;">
                                <div style="flex:1;">
                                    <div style="font-size:12px;font-weight:800;color:var(--muted);">{{ $proj->title }} ({{ ucfirst($proj->status) }})</div>
                                    <div style="font-size:9px;color:var(--light);">Category: {{ $proj->category }}</div>
                                </div>
                                <div style="display:flex;gap:5px;">
                                    <form action="{{ route('admin.projects.restore', $proj->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-undo"></i> Restore</button>
                                    </form>
                                    <form action="{{ route('admin.projects.destroy', $proj->id) }}" method="POST"
                                          @submit.prevent="triggerConfirm('Delete Permanently', 'Are you sure you want to permanently delete this project record?', () => $el.submit())">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ══ REPORTS ══ --}}
            <div x-show="tab==='reports'" x-transition>
                    
                    {{-- REPORTS SUB-NAVIGATION TABS --}}
                    <div class="no-print" style="display:flex;gap:12px;margin-bottom:20px;padding:8px;background:#f8fafc;border-radius:14px;border:1.5px solid #e2e8f0;width:fit-content;flex-wrap:wrap;">
                        <button type="button" @click="adminReportSection='overall'" 
                                :style="adminReportSection==='overall' ? 'background:linear-gradient(135deg,#000052 0%,#0E5393 100%);color:#fff;font-weight:900;box-shadow:0 3px 12px rgba(14,83,147,0.35);' : 'background:transparent;color:#475569;font-weight:800;'"
                                class="btn" style="border-radius:10px;padding:10px 22px;font-size:11px;display:flex;align-items:center;gap:8px;cursor:pointer;border:none;transition:all .18s;">
                            <i class="fas fa-chart-pie"></i> Overall System Reports
                        </button>
                        <button type="button" @click="adminReportSection='departments'" 
                                :style="adminReportSection==='departments' ? 'background:linear-gradient(135deg,#000052 0%,#0E5393 100%);color:#fff;font-weight:900;box-shadow:0 3px 12px rgba(14,83,147,0.35);' : 'background:transparent;color:#475569;font-weight:800;'"
                                class="btn" style="border-radius:10px;padding:10px 22px;font-size:11px;display:flex;align-items:center;gap:10px;cursor:pointer;border:none;transition:all .18s;">
                            <i class="fas fa-inbox"></i> Submitted Department Reports
                            <span style="padding:3px 10px;border-radius:99px;font-size:10px;font-weight:900;letter-spacing:.02em;" :style="adminReportSection==='departments' ? 'background:rgba(255,255,255,0.22);color:#fff;' : 'background:#e2e8f0;color:#0E5393;'">
                                {{ ($departmentReports ?? collect())->count() }} Received
                            </span>
                        </button>
                    </div>

                    {{-- ══ 1. OVERALL SYSTEM GENERATED REPORT ══ --}}
                    <div x-show="adminReportSection==='overall'" x-transition>
                        <div class="card no-print" style="margin-bottom:18px;">
                            <div class="card-head">
                                <div class="card-title"><i class="fas fa-file-alt"></i> Generate Barangay Report</div>
                                <div style="display:flex;align-items:center;flex-wrap:wrap;gap:8px;" class="no-print">
                                    <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print"></i>
                                        Print</button>
                                    <button onclick="downloadReport()" class="btn btn-primary"
                                        style="background:linear-gradient(135deg,#059669,#064e3b);"><i
                                            class="fas fa-download"></i> Download</button>
                                </div>
                            </div>
                            <div style="padding:16px 18px;border-bottom:1px solid #f1f5f9;" class="no-print">
                                <p style="font-size:10px;color:var(--muted);font-weight:600;">Select report type to preview then
                                    print:</p>
                                <div style="display:flex;justify-content:space-between;align-items:flex-end;gap:16px;margin-top:14px;flex-wrap:wrap;">
                                    <div style="display:flex;gap:8px;flex-wrap:wrap;">
                                        <button @click="reportType='full'" :class="reportType==='full'?'btn btn-primary btn-sm':'btn btn-ghost btn-sm'">Full Report</button>
                                        <button @click="reportType='residents'" :class="reportType==='residents'?'btn btn-primary btn-sm':'btn btn-ghost btn-sm'">Residents Only</button>
                                        <button @click="reportType='documents'" :class="reportType==='documents'?'btn btn-primary btn-sm':'btn btn-ghost btn-sm'">Documents Only</button>
                                        <button @click="reportType='issues'" :class="reportType==='issues'?'btn btn-primary btn-sm':'btn btn-ghost btn-sm'">Issues Only</button>
                                    </div>
                                    <div style="display:flex;gap:10px;flex:1;justify-content:flex-end;min-width:300px;align-items:flex-end;">
                                        <div style="flex:1;max-width:160px;">
                                            <label style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;display:block;margin-bottom:6px;letter-spacing:.05em;">Filter Month</label>
                                            <div style="position:relative;">
                                                <i class="fas fa-calendar-day" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);font-size:11px;color:#0E5393;pointer-events:none;"></i>
                                                <select x-model="reportMonth" class="form-control" style="font-size:11px;font-weight:700;height:36px;padding:0 12px 0 30px;border-radius:10px;border:1.5px solid #e2e8f0;background:#f8fafc;cursor:pointer;">
                                                    <option value="">All Months</option>
                                                    @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $idx => $m)
                                                        <option value="{{ $idx + 1 }}">{{ $m }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div style="flex:1;max-width:130px;">
                                            <label style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;display:block;margin-bottom:6px;letter-spacing:.05em;">Filter Year</label>
                                            <div style="position:relative;">
                                                <i class="fas fa-history" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);font-size:11px;color:#0E5393;pointer-events:none;"></i>
                                                <select x-model="reportYear" class="form-control" style="font-size:11px;font-weight:700;height:36px;padding:0 12px 0 30px;border-radius:10px;border:1.5px solid #e2e8f0;background:#f8fafc;cursor:pointer;">
                                                    @foreach(range(date('Y'), 2020) as $y)
                                                        <option value="{{ $y }}">{{ $y }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- REPORT PREVIEW CONTAINER --}}
                        <div id="print-report" style="background:#fff;border-radius:14px;padding:32px 36px;border:1px solid rgba(4,25,45,.08);box-shadow:var(--card-shadow);font-family:'Times New Roman', serif;color:#000;">
                            {{-- LETTERHEAD --}}
                            <div style="text-align:center;border-bottom:2px solid #000;padding-bottom:12px;margin-bottom:20px;">
                                <div style="display:flex;align-items:center;justify-content:center;gap:16px;margin-bottom:8px;">
                                    <img src="{{ asset('images/circlelogo.png') }}" style="width:58px;height:58px;object-fit:contain;">
                                    <div>
                                        <div style="font-size:10px;text-transform:uppercase;letter-spacing:1px;font-family:'Plus Jakarta Sans',sans-serif;color:#555;font-weight:600;">Republic of the Philippines &bull; Province of Cavite &bull; City of Dasmariñas</div>
                                        <div style="font-size:17px;font-weight:900;text-transform:uppercase;letter-spacing:1.5px;color:#000;margin:2px 0;font-family:'Plus Jakarta Sans',sans-serif;">Barangay San Miguel II</div>
                                        <div style="font-size:10px;font-weight:700;color:#333;font-family:'Plus Jakarta Sans',sans-serif;">Office of the Punong Barangay</div>
                                    </div>
                                </div>
                                <div style="font-size:13px;font-weight:900;text-transform:uppercase;letter-spacing:1px;margin-top:6px;font-family:'Plus Jakarta Sans',sans-serif;color:#0E5393;" x-text="reportTitle"></div>
                                <div style="font-size:10px;color:#555;margin-top:2px;font-family:'Plus Jakarta Sans',sans-serif;" x-text="'Generated on: ' + reportDate"></div>
                            </div>

                            {{-- I. RESIDENTS SUMMARY --}}
                            <template x-if="reportType==='full' || reportType==='residents'">
                                <div style="margin-bottom:24px;">
                                    <div style="font-size:11px;font-weight:900;text-transform:uppercase;letter-spacing:.08em;margin-bottom:10px;border-bottom:1px solid #000;padding-bottom:3px;font-family:'Plus Jakarta Sans',sans-serif;">I. Resident Summary</div>
                                    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-bottom:12px;">
                                        <div style="border:1px solid #ccc;border-radius:6px;padding:8px;text-align:center;"><div style="font-size:18px;font-weight:900;color:#000;" x-text="filteredResCount"></div><div style="font-size:9px;text-transform:uppercase;font-weight:700;color:#555;">Total (Filtered)</div></div>
                                        <div style="border:1px solid #ccc;border-radius:6px;padding:8px;text-align:center;"><div style="font-size:18px;font-weight:900;color:#000;">{{ $totalHouseholds }}</div><div style="font-size:9px;text-transform:uppercase;font-weight:700;color:#555;">Households Head</div></div>
                                        <div style="border:1px solid #ccc;border-radius:6px;padding:8px;text-align:center;"><div style="font-size:18px;font-weight:900;color:#000;">{{ $seniors }}</div><div style="font-size:9px;text-transform:uppercase;font-weight:700;color:#555;">Senior Citizens</div></div>
                                        <div style="border:1px solid #ccc;border-radius:6px;padding:8px;text-align:center;"><div style="font-size:18px;font-weight:900;color:#000;">{{ $pwds }}</div><div style="font-size:9px;text-transform:uppercase;font-weight:700;color:#555;">PWD</div></div>
                                        <div style="border:1px solid #ccc;border-radius:6px;padding:8px;text-align:center;"><div style="font-size:18px;font-weight:900;color:#000;">{{ $soloParents }}</div><div style="font-size:9px;text-transform:uppercase;font-weight:700;color:#555;">Solo Parents</div></div>
                                        <div style="border:1px solid #ccc;border-radius:6px;padding:8px;text-align:center;"><div style="font-size:18px;font-weight:900;color:#000;">{{ $students }}</div><div style="font-size:9px;text-transform:uppercase;font-weight:700;color:#555;">Students</div></div>
                                        <div style="border:1px solid #ccc;border-radius:6px;padding:8px;text-align:center;"><div style="font-size:18px;font-weight:900;color:#000;">{{ $voters }}</div><div style="font-size:9px;text-transform:uppercase;font-weight:700;color:#555;">Voters</div></div>
                                        <div style="border:1px solid #ccc;border-radius:6px;padding:8px;text-align:center;"><div style="font-size:18px;font-weight:900;color:#000;">{{ $totalPets }}</div><div style="font-size:9px;text-transform:uppercase;font-weight:700;color:#555;">Pets</div></div>
                                    </div>
                                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                                        <div style="border:1px solid #ccc;border-radius:6px;padding:8px;font-size:10px;"><strong>GENDER DISTRIBUTION:</strong> Male: {{ $male }} ({{ $totalResidents > 0 ? round(($male/$totalResidents)*100) : 0 }}%) &bull; Female: {{ $female }} ({{ $totalResidents > 0 ? round(($female/$totalResidents)*100) : 0 }}%)</div>
                                        <div style="border:1px solid #ccc;border-radius:6px;padding:8px;font-size:10px;"><strong>PET REGISTRY:</strong> Total: {{ $totalPets }} &bull; Vaccinated: {{ $vaccinated }} &bull; Unvaccinated: {{ $unvaccinated }}</div>
                                    </div>
                                </div>
                            </template>

                            {{-- II. DOCUMENT REQUESTS SUMMARY --}}
                            <template x-if="reportType==='full' || reportType==='documents'">
                                <div style="margin-bottom:24px;">
                                    <div style="font-size:11px;font-weight:900;text-transform:uppercase;letter-spacing:.08em;margin-bottom:10px;border-bottom:1px solid #000;padding-bottom:3px;font-family:'Plus Jakarta Sans',sans-serif;">II. Document Requests Summary</div>
                                    <div style="border:1px solid #ccc;border-radius:6px;padding:8px;text-align:center;margin-bottom:10px;"><div style="font-size:18px;font-weight:900;color:#000;" x-text="filteredDocsCount"></div><div style="font-size:9px;text-transform:uppercase;font-weight:700;color:#555;">Total Released Documents</div></div>
                                    <div style="font-size:9px;font-weight:700;text-transform:uppercase;margin-bottom:4px;color:#333;">Detailed Released Documents List:</div>
                                    <table style="width:100%;border-collapse:collapse;font-size:9.5px;text-align:left;border:1px solid #ccc;">
                                        <thead><tr style="background:#f1f5f9;"><th style="border:1px solid #ccc;padding:4px 6px;">Date Released</th><th style="border:1px solid #ccc;padding:4px 6px;">Control No.</th><th style="border:1px solid #ccc;padding:4px 6px;">Document Type</th><th style="border:1px solid #ccc;padding:4px 6px;">Requested By</th><th style="border:1px solid #ccc;padding:4px 6px;">Status</th></tr></thead>
                                        <tbody>
                                            <template x-for="d in filteredDocs" :key="d.id">
                                                <tr><td style="border:1px solid #ccc;padding:4px 6px;" x-text="d.date_fmt"></td><td style="border:1px solid #ccc;padding:4px 6px;" x-text="'DOC-'+String(d.id).padStart(4,'0')"></td><td style="border:1px solid #ccc;padding:4px 6px;text-transform:capitalize;" x-text="d.type"></td><td style="border:1px solid #ccc;padding:4px 6px;" x-text="d.requested_by"></td><td style="border:1px solid #ccc;padding:4px 6px;font-weight:bold;color:#059669;">RELEASED</td></tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </template>

                            {{-- III. ISSUE REPORTS SUMMARY --}}
                            <template x-if="reportType==='full' || reportType==='issues'">
                                <div style="margin-bottom:24px;">
                                    <div style="font-size:11px;font-weight:900;text-transform:uppercase;letter-spacing:.08em;margin-bottom:10px;border-bottom:1px solid #000;padding-bottom:3px;font-family:'Plus Jakarta Sans',sans-serif;">III. Issue Reports Summary</div>
                                    <div style="border:1px solid #ccc;border-radius:6px;padding:8px;text-align:center;margin-bottom:10px;"><div style="font-size:18px;font-weight:900;color:#000;" x-text="filteredIssuesCount"></div><div style="font-size:9px;text-transform:uppercase;font-weight:700;color:#555;">Total Settled Issues</div></div>
                                    <div style="font-size:9px;font-weight:700;text-transform:uppercase;margin-bottom:4px;color:#333;">Detailed Settled Issues List:</div>
                                    <table style="width:100%;border-collapse:collapse;font-size:9.5px;text-align:left;border:1px solid #ccc;">
                                        <thead><tr style="background:#f1f5f9;"><th style="border:1px solid #ccc;padding:4px 6px;">Date Settled</th><th style="border:1px solid #ccc;padding:4px 6px;">Case Number</th><th style="border:1px solid #ccc;padding:4px 6px;">Department</th><th style="border:1px solid #ccc;padding:4px 6px;">Complainant</th><th style="border:1px solid #ccc;padding:4px 6px;">Respondent</th><th style="border:1px solid #ccc;padding:4px 6px;">Resolution / Note</th></tr></thead>
                                        <tbody>
                                            <template x-for="i in filteredIssues" :key="i.id">
                                                <tr><td style="border:1px solid #ccc;padding:4px 6px;" x-text="i.date_fmt"></td><td style="border:1px solid #ccc;padding:4px 6px;" x-text="i.case_no"></td><td style="border:1px solid #ccc;padding:4px 6px;" x-text="i.dept"></td><td style="border:1px solid #ccc;padding:4px 6px;" x-text="i.complainant"></td><td style="border:1px solid #ccc;padding:4px 6px;" x-text="i.respondent"></td><td style="border:1px solid #ccc;padding:4px 6px;" x-text="i.resolution"></td></tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </template>

                            {{-- SIGNATURES --}}
                            <div style="margin-top:36px;display:flex;justify-content:space-between;padding:0 20px;">
                                <div style="text-align:center;width:200px;"><div style="border-bottom:1.5px solid #000;margin-bottom:4px;padding-bottom:18px;font-weight:bold;font-size:11px;">MARVIN M. BENIS</div><div style="font-size:9px;text-transform:uppercase;color:#555;">Punong Barangay</div></div>
                                <div style="text-align:center;width:200px;"><div style="border-bottom:1.5px solid #000;margin-bottom:4px;padding-bottom:18px;font-style:italic;color:#777;font-size:10px;">Prepared by / Admin</div><div style="font-size:9px;text-transform:uppercase;color:#555;">Barangay Secretary / Admin</div></div>
                            </div>

                            <div style="margin-top:20px;text-align:center;font-size:9px;color:#94a3b8;font-weight:600;border-top:1px solid #e2e8f0;padding-top:10px;">
                                This report was generated electronically by the Barangay SM2 Management System on {{ now()->format('F d, Y \a\t h:i A') }}.
                            </div>
                        </div>
                    </div>

                    {{-- ══ 2. SUBMITTED DEPARTMENT REPORTS (TRANSFERRED FROM VAWC, PEACE & ORDER, JUSTICE, OFFICE) ══ --}}
                    <div x-show="adminReportSection==='departments'" x-transition class="no-print">
                        <div class="card" style="margin-bottom:18px;">
                            <div class="card-head">
                                <div class="card-title">
                                    <i class="fas fa-inbox"></i> Department Transferred Reports Repository
                                </div>
                                <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                                    <span class="cbadge cbadge-blue">{{ ($departmentReports ?? collect())->count() }} Total Transferred</span>
                                </div>
                            </div>

                            {{-- DEPARTMENT FILTER BUTTONS --}}
                            <div style="padding:14px 20px;background:#f8fafc;border-bottom:1.5px solid #e2e8f0;display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                                <span style="font-size:10px;font-weight:900;color:#64748b;text-transform:uppercase;letter-spacing:.05em;margin-right:4px;">Filter Dept:</span>
                                <button type="button" @click="deptReportFilter='all'" :style="deptReportFilter==='all' ? 'background:linear-gradient(135deg,#000052 0%,#0E5393 100%);color:#fff;' : 'background:#fff;color:#475569;border:1px solid #cbd5e1;'" class="btn btn-sm" style="border-radius:8px;padding:6px 14px;font-weight:800;">All Departments</button>
                                <button type="button" @click="deptReportFilter='VAWC'" :style="deptReportFilter==='VAWC' ? 'background:#7c3aed;color:#fff;' : 'background:#fff;color:#7c3aed;border:1px solid #ddd6fe;'" class="btn btn-sm" style="border-radius:8px;padding:6px 14px;font-weight:800;"><i class="fas fa-hand-holding-heart"></i> VAWC</button>
                                <button type="button" @click="deptReportFilter='Peace & Order'" :style="deptReportFilter==='Peace & Order' ? 'background:#2563eb;color:#fff;' : 'background:#fff;color:#2563eb;border:1px solid #bfdbfe;'" class="btn btn-sm" style="border-radius:8px;padding:6px 14px;font-weight:800;"><i class="fas fa-shield-alt"></i> Peace & Order</button>
                                <button type="button" @click="deptReportFilter='Justice'" :style="deptReportFilter==='Justice' ? 'background:#059669;color:#fff;' : 'background:#fff;color:#059669;border:1px solid #a7f3d0;'" class="btn btn-sm" style="border-radius:8px;padding:6px 14px;font-weight:800;"><i class="fas fa-balance-scale"></i> Justice</button>
                                <button type="button" @click="deptReportFilter='Office'" :style="deptReportFilter==='Office' ? 'background:#0E5393;color:#fff;' : 'background:#fff;color:#0E5393;border:1px solid #bfdbfe;'" class="btn btn-sm" style="border-radius:8px;padding:6px 14px;font-weight:800;"><i class="fas fa-building"></i> Office</button>
                            </div>

                            {{-- SUBMITTED REPORTS TABLE --}}
                            <div style="overflow-x:auto;">
                                <table style="width:100%;border-collapse:collapse;min-width:900px;">
                                    <thead>
                                        <tr style="background:#f8fafc;border-bottom:1.5px solid #e2e8f0;">
                                            <th style="padding:12px 18px;font-size:9.5px;font-weight:900;color:#64748b;text-transform:uppercase;letter-spacing:.08em;text-align:left;width:150px;">Department</th>
                                            <th style="padding:12px 18px;font-size:9.5px;font-weight:900;color:#64748b;text-transform:uppercase;letter-spacing:.08em;text-align:left;">Report Title</th>
                                            <th style="padding:12px 18px;font-size:9.5px;font-weight:900;color:#64748b;text-transform:uppercase;letter-spacing:.08em;text-align:left;width:150px;">Reporting Period</th>
                                            <th style="padding:12px 18px;font-size:9.5px;font-weight:900;color:#64748b;text-transform:uppercase;letter-spacing:.08em;text-align:left;width:190px;">Submitted By</th>
                                            <th style="padding:12px 18px;font-size:9.5px;font-weight:900;color:#64748b;text-transform:uppercase;letter-spacing:.08em;text-align:left;width:160px;">Date Received</th>
                                            <th style="padding:12px 18px;font-size:9.5px;font-weight:900;color:#64748b;text-transform:uppercase;letter-spacing:.08em;text-align:left;width:110px;">Status</th>
                                            <th style="padding:12px 18px;font-size:9.5px;font-weight:900;color:#64748b;text-transform:uppercase;letter-spacing:.08em;text-align:right;width:140px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse(($departmentReports ?? collect()) as $rep)
                                        <tr x-show="deptReportFilter==='all' || deptReportFilter==='{{ $rep->department }}'" style="border-bottom:1px solid #f1f5f9;transition:background .15s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                            <td style="padding:14px 18px;vertical-align:middle;">
                                                @if($rep->department === 'VAWC')
                                                    <span style="display:inline-flex;align-items:center;gap:5px;font-size:9.5px;font-weight:900;background:#faf5ff;color:#7c3aed;border:1px solid #ddd6fe;padding:3px 10px;border-radius:99px;"><i class="fas fa-hand-holding-heart"></i> VAWC</span>
                                                @elseif($rep->department === 'Peace & Order')
                                                    <span style="display:inline-flex;align-items:center;gap:5px;font-size:9.5px;font-weight:900;background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;padding:3px 10px;border-radius:99px;"><i class="fas fa-shield-alt"></i> Peace & Order</span>
                                                @elseif($rep->department === 'Justice')
                                                    <span style="display:inline-flex;align-items:center;gap:5px;font-size:9.5px;font-weight:900;background:#ecfdf5;color:#059669;border:1px solid #a7f3d0;padding:3px 10px;border-radius:99px;"><i class="fas fa-balance-scale"></i> Justice</span>
                                                @else
                                                    <span style="display:inline-flex;align-items:center;gap:5px;font-size:9.5px;font-weight:900;background:#eff6ff;color:#0E5393;border:1px solid #bfdbfe;padding:3px 10px;border-radius:99px;">{{ $rep->department }}</span>
                                                @endif
                                            </td>
                                            <td style="padding:14px 18px;vertical-align:middle;">
                                                <div style="font-size:12px;font-weight:900;color:var(--text);line-height:1.4;">{{ $rep->report_title }}</div>
                                            </td>
                                            <td style="padding:14px 18px;vertical-align:middle;">
                                                <span style="font-size:10px;font-weight:900;background:#f1f5f9;color:#334155;border:1px solid #e2e8f0;padding:3px 10px;border-radius:99px;display:inline-block;white-space:nowrap;">{{ $rep->reporting_period }}</span>
                                            </td>
                                            <td style="padding:14px 18px;vertical-align:middle;">
                                                <div style="font-size:12px;font-weight:900;color:var(--text);">{{ $rep->submitted_by }}</div>
                                                <div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:2px;">{{ $rep->submitted_role ?? 'Department Officer' }}</div>
                                            </td>
                                            <td style="padding:14px 18px;vertical-align:middle;">
                                                <div style="font-size:11px;font-weight:800;color:var(--brand);">{{ $rep->created_at->format('M d, Y') }}</div>
                                                <div style="font-size:9.5px;color:var(--muted);font-weight:600;">{{ $rep->created_at->format('h:i A') }}</div>
                                            </td>
                                            <td style="padding:14px 18px;vertical-align:middle;">
                                                <span style="display:inline-flex;align-items:center;gap:4px;font-size:9.5px;font-weight:900;background:#dcfce7;color:#15803d;padding:3px 9px;border-radius:99px;white-space:nowrap;"><i class="fas fa-check-circle"></i> {{ ucfirst($rep->status) }}</span>
                                            </td>
                                            <td style="padding:14px 18px;vertical-align:middle;text-align:right;">
                                                <div style="display:inline-flex;gap:6px;align-items:center;">
                                                    <button type="button" @click="openReportModal({{ json_encode($rep) }})" class="btn btn-sm btn-primary" style="display:inline-flex;align-items:center;gap:6px;font-size:10px;padding:6px 14px;background:linear-gradient(135deg,#0E5393 0%,#04192D 100%);border-radius:8px;border:none;cursor:pointer;color:#fff;font-weight:800;" title="View Report Pop-up">
                                                        <i class="fas fa-eye"></i> View Report
                                                    </button>
                                                    @if($rep->template_file)
                                                    <a href="{{ asset('storage/' . $rep->template_file) }}" target="_blank" class="btn btn-sm btn-ghost" style="display:inline-flex;align-items:center;gap:5px;font-size:10px;padding:6px 10px;border-radius:8px;" title="View Attached Custom Template Format">
                                                        <i class="fas fa-paperclip"></i>
                                                    </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" style="padding:40px;text-align:center;">
                                                <div class="tbl-empty">
                                                    <i class="fas fa-inbox" style="font-size:32px;color:#94a3b8;margin-bottom:10px;display:block;"></i>
                                                    <p style="font-size:12px;font-weight:800;color:var(--text);">No department reports received yet.</p>
                                                    <p style="font-size:10px;color:var(--muted);margin-top:4px;">When VAWC, Peace & Order, Justice, or Office submit monthly compliance reports, they will appear here.</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            {{-- ══ WEBSITE CONTENT ══ --}}
            <div x-show="tab==='website'" x-transition>
                <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(450px, 1fr));gap:var(--gap);align-items:start;">
                    
                    {{-- CAROUSEL MANAGEMENT --}}
                    <div>
                        <div class="card">
                            <div class="card-head">
                                <div class="card-title"><i class="fas fa-images"></i> Home Slideshow ({{ $carouselSlides->count() }} / 6)</div>
                                @if($carouselSlides->count() < 6)
                                    <button @click="addSlideModal=true;slidePhotoPreview=null" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Slide</button>
                                @else
                                    <button class="btn btn-ghost btn-sm" disabled title="Maximum of 6 slides reached"><i class="fas fa-lock"></i> Max Reached</button>
                                @endif
                            </div>
                            <div style="padding:16px;">
                                <p style="font-size:10px;color:var(--muted);margin-bottom:12px;font-weight:600;">Manage the images displayed on the landing page slideshow.</p>
                                
                                @if($carouselSlides->isEmpty())
                                    <div class="empty-st"><i class="fas fa-images"></i><p>No slides yet.</p></div>
                                @else
                                    <div style="display:grid;gap:12px;">
                                        @foreach($carouselSlides as $slide)
                                            <div style="display:flex;align-items:center;gap:12px;background:#f8fafc;border:1px solid var(--border);border-radius:12px;padding:10px;">
                                                <div style="width:80px;height:50px;border-radius:8px;overflow:hidden;flex-shrink:0;border:1px solid var(--border);">
                                                    <img src="{{ asset('storage/' . $slide->image_path) }}" 
                                                         onerror="this.onerror=null; this.src='{{ asset('images/cleanup.jpg') }}';"
                                                         style="width:100%;height:100%;object-fit:cover;">
                                                </div>
                                                <div style="flex:1;min-width:0;">
                                                    <div style="font-size:12px;font-weight:800;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $slide->title ?? 'Untitled Slide' }}</div>
                                                    <div style="display:flex;align-items:center;gap:6px;margin-top:2px;">
                                                        <span class="cbadge {{ $slide->is_active ? 'cbadge-green' : 'cbadge-red' }}" style="font-size:8px;">{{ $slide->is_active ? 'Active' : 'Inactive' }}</span>
                                                        <span style="font-size:9px;color:var(--light);font-weight:600;">Order: {{ $slide->sort_order }}</span>
                                                    </div>
                                                </div>
                                                <div style="display:flex;gap:5px;">
                                                    <div x-data="{ editModal: false, photoPreview: '{{ asset('storage/' . $slide->image_path) }}' }">
                                                        <button @click="editModal=true" class="btn btn-sm btn-ghost" style="padding:6px;"><i class="fas fa-edit"></i></button>
                                                        
                                                        {{-- Individual Carousel Edit Modal --}}
                                                        <div x-show="editModal" x-cloak class="modal-ov" x-transition style="text-align:left;z-index:9999;">
                                                            <div class="modal-box" @click.away="editModal=false" style="margin: 20px auto;">
                                                                <div class="modal-in">
                                                                    <div class="modal-hd">
                                                                        <div class="modal-ttl"><div class="mico"><i class="fas fa-edit"></i></div> Edit Carousel Slide</div>
                                                                        <button @click="editModal=false" class="mclose"><i class="fas fa-times-circle"></i></button>
                                                                    </div>
                                                                    <form action="{{ route('admin.carousel.update', $slide->id) }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf @method('PUT')
                                                                        <div class="fgrp"><label class="flbl">Slide Image</label>
                                                                            <label style="cursor:pointer;display:block;">
                                                                                <div style="height:150px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;transition:all .2s;" :style="photoPreview?'border:2px solid #0E5393':''">
                                                                                    <img x-show="photoPreview" :src="photoPreview" style="width:100%;height:100%;object-fit:contain;">
                                                                                    <div x-show="!photoPreview" style="text-align:center;"><i class="fas fa-image" style="font-size:24px;color:var(--light);margin-bottom:6px;"></i><div style="font-size:11px;font-weight:800;color:var(--muted);text-transform:uppercase;">Change Photo</div></div>
                                                                                </div>
                                                                                <input type="file" name="image" accept="image/*" style="display:none;" @change="const f=$event.target.files[0];if(f){const r=new FileReader();r.onload=e=>photoPreview=e.target.result;r.readAsDataURL(f)}">
                                                                            </label>
                                                                        </div>
                                                                        <div class="fgrp"><label class="flbl">Title</label><input type="text" name="title" class="finput" value="{{ $slide->title }}"></div>
                                                                        <div class="fgrp">
                                                                            <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                                                                                <input type="checkbox" name="is_active" {{ $slide->is_active ? 'checked' : '' }} value="1">
                                                                                <span style="font-size:12px;font-weight:800;color:var(--text);">Active</span>
                                                                            </label>
                                                                        </div>
                                                                        <div style="display:flex;justify-content:flex-end;gap:9px;"><button type="button" @click="editModal=false" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-primary">Save Changes</button></div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('admin.carousel.destroy', $slide->id) }}" method="POST" @submit.prevent="triggerConfirm('Delete Slide', 'Remove this slide from the carousel?', () => $el.submit())">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-ghost" style="padding:6px;color:#ef4444;"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- SITE SETTINGS (ORG CHART) --}}
                    <div>
                        <div class="card">
                            <div class="card-head">
                                <div class="card-title"><i class="fas fa-sitemap"></i> Organizational Chart</div>
                            </div>
                            <div style="padding:16px;">
                                <p style="font-size:10px;color:var(--muted);margin-bottom:12px;font-weight:600;">Upload the latest organizational chart picture. This will be visible to legitimate residents.</p>
                                
                                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" x-data="{uploading:false}" x-ref="orgForm">
                                    @csrf
                                    <div style="background:#f8fafc;border:2px dashed var(--border);border-radius:12px;padding:20px;text-align:center;margin-bottom:16px;transition:all .2s;"
                                         @dragover.prevent="$el.style.borderColor='var(--brand)';$el.style.background='#eff6ff'"
                                         @dragleave.prevent="$el.style.borderColor='var(--border)';$el.style.background='#f8fafc'"
                                         @drop.prevent="$refs.orgFileInput.files=$event.dataTransfer.files;$refs.orgForm.submit();uploading=true">
                                        @if($orgChartPath)
                                            <div style="max-width:300px;margin:0 auto 15px;border-radius:8px;overflow:hidden;box-shadow:var(--card-shadow);border:1px solid var(--border);">
                                                <img src="{{ asset('storage/' . $orgChartPath) }}" style="width:100%;display:block;">
                                            </div>
                                            <div style="font-size:10px;color:var(--brand);font-weight:800;margin-bottom:10px;"><i class="fas fa-check-circle"></i> Current Chart Active</div>
                                        @else
                                            <div style="padding:30px 0;color:var(--light);">
                                                <i class="fas fa-image" style="font-size:40px;opacity:.2;margin-bottom:10px;"></i>
                                                <div style="font-size:11px;font-weight:700;">No Organizational Chart uploaded yet.</div>
                                            </div>
                                        @endif

                                        <label class="btn btn-primary" style="cursor:pointer;display:inline-flex;">
                                            <i class="fas fa-upload"></i> {{ $orgChartPath ? 'Replace Chart Image' : 'Upload Chart Image' }}
                                            <input type="file" name="organizational_chart" accept="image/*" style="display:none;" x-ref="orgFileInput" @change="uploading=true;$refs.orgForm.submit()">
                                        </label>
                                        <div x-show="uploading" x-cloak style="margin-top:10px;font-size:10px;font-weight:800;color:var(--brand);">
                                            <i class="fas fa-spinner fa-spin"></i> Uploading...
                                        </div>
                                        <div style="font-size:9px;color:var(--light);margin-top:8px;font-weight:600;">Drag and drop image here to replace</div>
                                    </div>
                                </form>
                                <div style="background:rgba(14,83,147,0.05);border-radius:10px;padding:12px;border:1px solid rgba(14,83,147,0.1);">
                                    <div style="display:flex;gap:10px;align-items:flex-start;">
                                        <i class="fas fa-info-circle" style="color:var(--brand);margin-top:2px;"></i>
                                        <div style="font-size:10px;color:var(--brand);font-weight:700;line-height:1.5;">
                                            Tip: Use a high-resolution image (landscape preferred) for the organizational chart so residents can read the names clearly.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- QUICK LINK FROM EVENTS/ANNOUNCEMENTS --}}
                <div style="margin-top:var(--gap);">
                    <div class="card">
                        <div class="card-head">
                            <div class="card-title"><i class="fas fa-link"></i> Link Past Events/Announcements to Slideshow</div>
                        </div>
                        <div style="padding:16px;">
                            <p style="font-size:10px;color:var(--muted);margin-bottom:12px;font-weight:600;">Quickly add recent activities to the homepage slideshow. (Requires record to have an image)</p>
                            
                            <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(280px, 1fr));gap:12px;">
                                {{-- Recent Events --}}
                                @foreach($events->take(3) as $evt)
                                    @if($evt->image_path)
                                        <div style="display:flex;align-items:center;gap:12px;background:#fff;border:1px solid var(--border);border-radius:12px;padding:10px;">
                                            <div style="width:60px;height:40px;border-radius:6px;overflow:hidden;flex-shrink:0;">
                                                <img src="{{ asset('storage/' . $evt->image_path) }}" 
                                                     onerror="this.onerror=null; this.src='{{ asset('images/cleanup.jpg') }}';"
                                                     style="width:100%;height:100%;object-fit:cover;">
                                            </div>
                                            <div style="flex:1;min-width:0;">
                                                <div style="font-size:11px;font-weight:800;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $evt->title }}</div>
                                                <div style="font-size:8px;color:var(--muted);font-weight:700;text-transform:uppercase;">Event</div>
                                            </div>
                                            <form action="{{ route('admin.carousel.link', ['type' => 'event', 'id' => $evt->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-ghost" {{ $carouselSlides->count() >= 6 ? 'disabled' : '' }} title="Link to Slideshow"><i class="fas fa-plus"></i></button>
                                            </form>
                                        </div>
                                    @endif
                                @endforeach

                                {{-- Recent Announcements --}}
                                @foreach($announcements->take(3) as $ann)
                                    @if($ann->image_path)
                                        <div style="display:flex;align-items:center;gap:12px;background:#fff;border:1px solid var(--border);border-radius:12px;padding:10px;">
                                            <div style="width:60px;height:40px;border-radius:6px;overflow:hidden;flex-shrink:0;">
                                                <img src="{{ asset('storage/' . $ann->image_path) }}" 
                                                     onerror="this.onerror=null; this.src='{{ asset('images/cleanup.jpg') }}';"
                                                     style="width:100%;height:100%;object-fit:cover;">
                                            </div>
                                            <div style="flex:1;min-width:0;">
                                                <div style="font-size:11px;font-weight:800;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $ann->title }}</div>
                                                <div style="font-size:8px;color:var(--muted);font-weight:700;text-transform:uppercase;">Announcement</div>
                                            </div>
                                            <form action="{{ route('admin.carousel.link', ['type' => 'announcement', 'id' => $ann->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-ghost" {{ $carouselSlides->count() >= 6 ? 'disabled' : '' }} title="Link to Slideshow"><i class="fas fa-plus"></i></button>
                                            </form>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══ SYSTEM / BACKUP ══ --}}
            <div x-show="tab==='system'" x-transition>
                <div class="sg">
                    <div class="card" style="grid-column: span 2;">
                        <div class="card-head">
                            <div class="card-title"><i class="fas fa-database"></i> System Backup & Maintenance</div>
                        </div>
                        <div style="padding:20px;">
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                                <div>
                                    <h3 style="font-size:14px; font-weight:800; color:var(--text);">Create New Backup</h3>
                                    <p style="font-size:11px; color:var(--muted); font-weight:600;">This will generate a ZIP file containing the full database and all uploaded files (photos/IDs).</p>
                                </div>
                                <form action="/admin/backups/run" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="background:var(--btn-grad); color:#fff; border:none; padding:10px 20px; border-radius:10px; font-weight:800; cursor:pointer;">
                                        <i class="fas fa-save"></i> Run Backup Now
                                    </button>
                                </form>
                            </div>

                            <div style="background:#f8fafc; border:1px solid var(--border); border-radius:15px; overflow:hidden;">
                                <table style="width:100%; border-collapse:collapse; font-size:12px;">
                                    <thead style="background:#fff;">
                                        <tr>
                                            <th style="padding:15px; text-align:left; color:var(--muted); text-transform:uppercase; font-size:10px;">Backup Filename</th>
                                            <th style="padding:15px; text-align:left; color:var(--muted); text-transform:uppercase; font-size:10px;">Size</th>
                                            <th style="padding:15px; text-align:left; color:var(--muted); text-transform:uppercase; font-size:10px;">Created At</th>
                                            <th style="padding:15px; text-align:right; color:var(--muted); text-transform:uppercase; font-size:10px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="b in backups" :key="b.name">
                                            <tr style="border-top:1px solid var(--border); background:#fff;">
                                                <td style="padding:15px; font-weight:700; color:var(--text);"><i class="fas fa-file-archive" style="color:var(--brand); margin-right:8px;"></i> <span x-text="b.name"></span></td>
                                                <td style="padding:15px; font-weight:600; color:var(--muted);" x-text="b.size"></td>
                                                <td style="padding:15px; font-weight:600; color:var(--light);" x-text="b.date"></td>
                                                <td style="padding:15px; text-align:right;">
                                                    <div style="display:flex; justify-content:flex-end; gap:8px;">
                                                        <a :href="'/admin/backups/download/' + b.name" class="btn btn-sm" style="background:#eff6ff; color:#0E5393; padding:6px 12px; border-radius:8px; text-decoration:none; font-weight:800; font-size:10px;">
                                                            <i class="fas fa-download"></i> Download
                                                        </a>
                                                        <form :action="'/admin/backups/delete/' + b.name" method="POST" onsubmit="return confirm('Delete this backup permanentiy?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" style="background:#fee2e2; color:#dc2626; border:none; padding:6px 12px; border-radius:8px; font-weight:800; font-size:10px; cursor:pointer;">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                        <template x-if="backups.length === 0">
                                            <tr>
                                                <td colspan="4" style="padding:40px; text-align:center; color:var(--light); font-weight:600;">
                                                    <i class="fas fa-history" style="font-size:30px; opacity:0.2; display:block; margin-bottom:10px;"></i>
                                                    No backups found. Create your first backup above!
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <div class="card-title"><i class="fas fa-clock"></i> Auto-Backup Settings</div>
                        </div>
                        <div style="padding:20px;">
                            <div style="background:#eff6ff; border:1px solid #bfdbfe; border-radius:12px; padding:15px; margin-bottom:15px;">
                                <div style="display:flex; gap:10px; align-items:flex-start;">
                                    <i class="fas fa-info-circle" style="color:#0E5393; margin-top:3px;"></i>
                                    <div>
                                        <h4 style="font-size:12px; font-weight:800; color:#0E5393; margin-bottom:4px;">Automated Backups</h4>
                                        <p style="font-size:10px; color:#1e40af; font-weight:600; line-height:1.4;">The system is configured to perform a full backup every 12:00 midnight. Ensure your server's scheduler (cron) is active.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="display:flex; align-items:center; justify-content:space-between; padding:10px 0; border-bottom:1px solid var(--border);">
                                <span style="font-size:11px; font-weight:700; color:var(--text);">Daily Database Dump</span>
                                <span style="font-size:9px; font-weight:800; color:var(--success); background:rgba(5,150,105,.1); padding:2px 8px; border-radius:99px;">ACTIVE</span>
                            </div>
                            <div style="display:flex; align-items:center; justify-content:space-between; padding:10px 0; border-bottom:1px solid var(--border);">
                                <span style="font-size:11px; font-weight:700; color:var(--text);">Weekly File Storage Sync</span>
                                <span style="font-size:9px; font-weight:800; color:var(--success); background:rgba(5,150,105,.1); padding:2px 8px; border-radius:99px;">ACTIVE</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ══ STAFF SECURITY & PASSWORD RECOVERY Q&A ══ --}}
                <div class="card" style="margin-top:20px;">
                    <div class="card-head" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
                        <div class="card-title" style="display:flex;align-items:center;gap:10px;">
                            <div style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#0E5393 0%,#000052 100%);color:#fff;display:flex;align-items:center;justify-content:center;font-size:14px;box-shadow:0 3px 8px rgba(0,0,82,0.2);">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <div>
                                <span style="font-weight:900;color:var(--text);font-size:14px;">Staff & Department Portal Accounts Management</span>
                                <div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:1px;">Manage assigned officer names, registered official emails, and password recovery security questions per department portal</div>
                            </div>
                        </div>
                        <span class="cbadge" style="background:#eff6ff;color:#0E5393;border:1px solid #bfdbfe;font-weight:800;font-size:10px;">
                            <i class="fas fa-lock" style="margin-right:4px;"></i> {{ $staffAccounts->count() }} Department Portals
                        </span>
                    </div>

                    <div style="padding:20px;">
                        {{-- Informational Banner --}}
                        <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-left:4px solid #16a34a;border-radius:12px;padding:12px 16px;margin-bottom:20px;display:flex;align-items:flex-start;gap:12px;">
                            <i class="fas fa-shield-check" style="color:#16a34a;font-size:16px;margin-top:2px;"></i>
                            <div style="font-size:11px;color:#166534;line-height:1.5;">
                                <strong style="font-weight:900;">Recovery Question Protection:</strong>
                                Department staff and officials use these secret questions to verify their identity and reset their passwords if locked out or forgotten.
                                <span style="display:block;margin-top:2px;color:#15803d;font-weight:700;">
                                    💡 <strong>Case-Insensitive:</strong> Answers will match regardless of uppercase or lowercase letters (e.g., <code>BRGY-2026</code> is recognized the same as <code>brgy-2026</code>).
                                </span>
                            </div>
                        </div>

                        {{-- Table of Accounts --}}
                        <div style="background:#fff;border:1px solid var(--border);border-radius:14px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.02);">
                            <div style="overflow-x:auto;">
                                <table style="width:100%;border-collapse:collapse;font-size:12px;text-align:left;">
                                    <thead>
                                        <tr style="background:#f8fafc;border-bottom:1.5px solid var(--border);">
                                            <th style="padding:14px 16px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.06em;color:var(--muted);">Department / Account</th>
                                            <th style="padding:14px 16px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.06em;color:var(--muted);">Active Security Question</th>
                                            <th style="padding:14px 16px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.06em;color:var(--muted);">Answer (Secret)</th>
                                            <th style="padding:14px 16px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:0.06em;color:var(--muted);text-align:right;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($staffAccounts as $acc)
                                        @php
                                            $roleStyles = [
                                                'admin'   => ['bg' => '#fee2e2', 'color' => '#991b1b', 'border' => '#fecaca', 'label' => 'System Admin', 'icon' => 'fa-crown'],
                                                'office'  => ['bg' => '#eff6ff', 'color' => '#1d4ed8', 'border' => '#bfdbfe', 'label' => 'Office Staff', 'icon' => 'fa-building'],
                                                'vawc'    => ['bg' => '#fdf4ff', 'color' => '#86198f', 'border' => '#f5d0fe', 'label' => 'VAWC Desk', 'icon' => 'fa-female'],
                                                'justice' => ['bg' => '#fffbeb', 'color' => '#b45309', 'border' => '#fde68a', 'label' => 'Justice / KP', 'icon' => 'fa-balance-scale'],
                                                'peace'   => ['bg' => '#f0fdf4', 'color' => '#166534', 'border' => '#bbf7d0', 'label' => 'Peace & Order', 'icon' => 'fa-shield-alt'],
                                            ];
                                            $style = $roleStyles[$acc->role] ?? ['bg' => '#f1f5f9', 'color' => '#334155', 'border' => '#cbd5e1', 'label' => ucfirst($acc->role), 'icon' => 'fa-user'];
                                        @endphp
                                        <tr style="border-bottom:1px solid var(--border);" x-data="{ showRowAnswer: false }">
                                            <td style="padding:14px 16px;vertical-align:middle;">
                                                <div style="display:flex;align-items:center;gap:12px;">
                                                    <div style="width:36px;height:36px;border-radius:10px;background:{{ $style['bg'] }};color:{{ $style['color'] }};border:1px solid {{ $style['border'] }};display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0;">
                                                        <i class="fas {{ $style['icon'] }}"></i>
                                                    </div>
                                                    <div>
                                                        <div style="font-weight:900;color:var(--text);font-size:13px;">{{ $acc->name }}</div>
                                                        <div style="display:flex;align-items:center;gap:6px;margin-top:2px;">
                                                            <span style="font-size:8.5px;font-weight:900;padding:2px 7px;border-radius:6px;background:{{ $style['bg'] }};color:{{ $style['color'] }};border:1px solid {{ $style['border'] }};text-transform:uppercase;letter-spacing:0.04em;">
                                                                {{ $style['label'] }}
                                                            </span>
                                                            <span style="font-size:10px;color:var(--muted);font-weight:600;">{{ $acc->email }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding:14px 16px;vertical-align:middle;max-width:320px;">
                                                @if(!empty($acc->security_question))
                                                    <div style="font-weight:700;color:#1e293b;font-size:12px;line-height:1.4;">
                                                        <i class="fas fa-question-circle" style="color:var(--brand);margin-right:5px;"></i> {{ $acc->security_question }}
                                                    </div>
                                                @else
                                                    <span style="font-size:11px;color:#94a3b8;font-style:italic;">No security question configured</span>
                                                @endif
                                            </td>
                                            <td style="padding:14px 16px;vertical-align:middle;">
                                                @if(!empty($acc->security_answer))
                                                    <div style="display:inline-flex;align-items:center;gap:8px;background:#f8fafc;border:1px solid var(--border);padding:5px 10px;border-radius:8px;">
                                                        <template x-if="!showRowAnswer">
                                                            <span style="letter-spacing:0.2em;font-weight:900;color:#64748b;font-size:13px;">••••••••</span>
                                                        </template>
                                                        <template x-if="showRowAnswer">
                                                            <span style="font-weight:800;color:#0f172a;font-size:12px;font-family:monospace;background:#e2e8f0;padding:1px 6px;border-radius:4px;">{{ $acc->security_answer }}</span>
                                                        </template>
                                                        <button type="button" @click="showRowAnswer = !showRowAnswer" style="border:none;background:transparent;cursor:pointer;color:#64748b;padding:0;font-size:11px;outline:none;" :title="showRowAnswer ? 'Hide answer' : 'Reveal answer'">
                                                            <i class="fas" :class="showRowAnswer ? 'fa-eye-slash' : 'fa-eye'"></i>
                                                        </button>
                                                    </div>
                                                @else
                                                    <span style="font-size:11px;color:#dc2626;font-weight:700;">Not Set</span>
                                                @endif
                                            </td>
                                            <td style="padding:14px 16px;vertical-align:middle;text-align:right;">
                                                <button type="button" @click="openStaffSecurityModal(@js($acc))" class="btn btn-sm" style="background:#0E5393;color:#fff;font-weight:800;border-radius:8px;padding:7px 14px;box-shadow:0 2px 6px rgba(14,83,147,0.2);display:inline-flex;align-items:center;gap:6px;">
                                                    <i class="fas fa-user-edit"></i> Edit Account & Security
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- /dash-wrap --}}

        {{-- ══ INTERACTIVE LIST MODALS ══ --}}

        {{-- Resident List Modal --}}
        <div x-show="showResList" x-cloak class="modal-ov" x-transition @click.self="showResList=false">
            <div class="modal-box" style="max-width: 900px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico"><i class="fas fa-users"></i></div>
                            <span x-text="resModalTitle"></span>
                            <span style="font-size: 11px; font-weight: 700; color: var(--muted); margin-left: 6px;" x-text="'(' + filteredResidentList.length + ')'"></span>
                        </div>
                        <button @click="showResList=false" class="mclose"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <div style="margin-bottom: 16px; display: flex; gap: 10px; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 240px; position: relative;">
                            <input type="text" x-model="resSearchQuery" placeholder="Search by name, code, or address..." class="finput" style="width: 100%; padding-left: 32px;">
                            <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--light); font-size: 11px;"></i>
                        </div>
                        <div style="position: relative; min-width: 220px;">
                            <select x-model="resFilterType" @change="
                                const titles = {
                                    'all': 'Total Residents Masterlist',
                                    'voter': 'Registered Voters List',
                                    'pending': 'Pending Verification / Non-Voters',
                                    'senior': 'Senior Citizens',
                                    'pwd': 'Persons with Disabilities (PWD)',
                                    'solo_parent': 'Solo Parents',
                                    'student': 'Students',
                                    'minor': 'Minors (< 18 yrs)',
                                    'adult': 'Adults (18–59 yrs)',
                                    'bedridden': 'Bed-ridden Residents',
                                    'with_account': 'With Accounts',
                                    'birthday': 'Birthday Celebrants (This Month)'
                                };
                                resModalTitle = titles[resFilterType] || 'Resident Masterlist';
                            " class="finput" style="padding-left: 32px; font-weight: 700; font-size: 11px; background: #fff; cursor: pointer;">
                                <option value="all">All Residents</option>
                                <option value="voter">Registered Voters</option>
                                <option value="pending">Non-Voters / Pending</option>
                                <option value="senior">Senior Citizens</option>
                                <option value="pwd">PWD</option>
                                <option value="solo_parent">Solo Parents</option>
                                <option value="student">Students</option>
                                <option value="minor">Minors (< 18 yrs)</option>
                                <option value="adult">Adults (18–59 yrs)</option>
                                <option value="bedridden">Bed-ridden</option>
                                <option value="with_account">With Account</option>
                                <option value="birthday">Birthdays (This Month)</option>
                            </select>
                            <i class="fas fa-filter" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #0E5393; font-size: 11px; pointer-events: none;"></i>
                        </div>
                    </div>
                    <div style="overflow-x: auto; max-height: 60vh;">
                        <table style="width:100%; border-collapse: collapse; font-size: 11px;">
                            <thead style="position: sticky; top: 0; background: #fff; z-index: 10; box-shadow: 0 1px 0 var(--border);">
                                <tr>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Resident</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Code</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Details</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Status / Badges</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="r in filteredResidentList" :key="r.id">
                                    <tr style="border-bottom: 1px solid #f8fafc;">
                                        <td style="padding: 12px;">
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <img :src="r.photo ? '/storage/' + r.photo : 'https://ui-avatars.com/api/?name=' + encodeURIComponent((r.first_name||'') + '+' + (r.last_name||'')) + '&background=0E5393&color=fff'" style="width: 32px; height: 32px; border-radius: 8px; object-fit: cover;">
                                                <div>
                                                    <div style="font-weight: 800; color: var(--text);" x-text="(r.first_name || '') + ' ' + (r.last_name || '') + (r.suffix ? ' ' + r.suffix : '')"></div>
                                                    <div style="font-size: 9px; color: var(--light);" x-text="r.address || 'San Miguel II'"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 12px; font-weight: 700; color: var(--brand);" x-text="r.resident_code || ('RES-' + r.id)"></td>
                                        <td style="padding: 12px; color: var(--muted);">
                                            <span x-text="r.gender || '—'"></span> • <span x-text="(r.age || '—') + ' yrs'"></span>
                                        </td>
                                        <td style="padding: 12px;">
                                            <div style="display: flex; gap: 4px; flex-wrap: wrap;">
                                                <template x-if="r.is_voter"><span style="background: #eff6ff; color: #1d4ed8; padding: 2px 6px; border-radius: 4px; font-size: 8px; font-weight: 900;">VOTER</span></template>
                                                <template x-if="!r.is_voter"><span style="background: #f1f5f9; color: #64748b; padding: 2px 6px; border-radius: 4px; font-size: 8px; font-weight: 900;">NON-VOTER</span></template>
                                                <template x-if="r.is_senior"><span style="background: #fef3c7; color: #92400e; padding: 2px 6px; border-radius: 4px; font-size: 8px; font-weight: 900;">SENIOR</span></template>
                                                <template x-if="r.is_pwd"><span style="background: #fce7f3; color: #be185d; padding: 2px 6px; border-radius: 4px; font-size: 8px; font-weight: 900;">PWD</span></template>
                                                <template x-if="r.is_single_parent"><span style="background: #fdf2f8; color: #9d174d; padding: 2px 6px; border-radius: 4px; font-size: 8px; font-weight: 900;">SOLO PARENT</span></template>
                                                <template x-if="r.is_student"><span style="background: #ecfdf5; color: #047857; padding: 2px 6px; border-radius: 4px; font-size: 8px; font-weight: 900;">STUDENT</span></template>
                                                <template x-if="r.is_bedridden"><span style="background: #fef2f2; color: #b91c1c; padding: 2px 6px; border-radius: 4px; font-size: 8px; font-weight: 900;">BEDRIDDEN</span></template>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                                <template x-if="filteredResidentList.length === 0">
                                    <tr>
                                        <td colspan="4" style="padding: 30px; text-align: center; color: var(--light); font-weight: 600;">
                                            <i class="fas fa-user-slash" style="display: block; font-size: 20px; margin-bottom: 8px; opacity: 0.5;"></i>
                                            No residents found matching your criteria.
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Document Requests Modal --}}
        <div x-show="showDocsList" x-cloak class="modal-ov" x-transition @click.self="showDocsList=false">
            <div class="modal-box" style="max-width: 800px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico"><i class="fas fa-file-invoice"></i></div>
                            <span>Document Requests</span>
                            <span style="font-size: 11px; font-weight: 700; color: var(--muted); margin-left: 6px;" x-text="'(' + filteredDocsList.length + ')'"></span>
                        </div>
                        <button @click="showDocsList=false" class="mclose"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <div style="margin-bottom: 14px; position: relative;">
                        <input type="text" x-model="docSearchQuery" placeholder="Search by document type, resident, or status..." class="finput" style="width: 100%; padding-left: 32px;">
                        <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--light); font-size: 11px;"></i>
                    </div>
                    <div style="overflow-x: auto; max-height: 60vh;">
                        <table style="width:100%; border-collapse: collapse; font-size: 11px;">
                            <thead style="position: sticky; top: 0; background: #fff; z-index: 10; box-shadow: 0 1px 0 var(--border);">
                                <tr>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Document</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Resident</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Requested At</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="d in filteredDocsList" :key="d.id">
                                    <tr style="border-bottom: 1px solid #f8fafc;">
                                        <td style="padding: 12px; font-weight: 800; color: var(--text);" x-text="d.document_type"></td>
                                        <td style="padding: 12px; color: var(--muted);" x-text="d.user ? (d.user.first_name ? (d.user.first_name + ' ' + d.user.last_name) : d.user.name) : (d.guest_first_name ? (d.guest_first_name + ' ' + d.guest_last_name) : 'Guest User')"></td>
                                        <td style="padding: 12px; color: var(--light);" x-text="new Date(d.created_at).toLocaleDateString()"></td>
                                        <td style="padding: 12px;">
                                            <span :class="{
                                                'bg-amber-100 text-amber-700': d.status === 'pending',
                                                'bg-blue-100 text-blue-700': d.status === 'processing',
                                                'bg-emerald-100 text-emerald-700': d.status === 'ready'
                                            }" style="padding: 4px 10px; border-radius: 99px; font-size: 9px; font-weight: 900; text-transform: uppercase;" x-text="d.statusLabel || d.status"></span>
                                        </td>
                                    </tr>
                                </template>
                                <template x-if="filteredDocsList.length === 0">
                                    <tr>
                                        <td colspan="4" style="padding: 30px; text-align: center; color: var(--light); font-weight: 600;">
                                            <i class="fas fa-folder-open" style="display: block; font-size: 20px; margin-bottom: 8px; opacity: 0.5;"></i>
                                            No document requests found.
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pet Registry Modal --}}
        <div x-show="showPetsList" x-cloak class="modal-ov" x-transition @click.self="showPetsList=false">
            <div class="modal-box" style="max-width: 800px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico"><i class="fas fa-paw"></i></div>
                            <span>Pet Registry</span>
                            <span style="font-size: 11px; font-weight: 700; color: var(--muted); margin-left: 6px;" x-text="'(' + filteredPetsList.length + ')'"></span>
                        </div>
                        <button @click="showPetsList=false" class="mclose"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <div style="margin-bottom: 14px; position: relative;">
                        <input type="text" x-model="petSearchQuery" placeholder="Search by pet name, type, breed, or owner..." class="finput" style="width: 100%; padding-left: 32px;">
                        <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--light); font-size: 11px;"></i>
                    </div>
                    <div style="overflow-x: auto; max-height: 60vh;">
                        <table style="width:100%; border-collapse: collapse; font-size: 11px;">
                            <thead style="position: sticky; top: 0; background: #fff; z-index: 10; box-shadow: 0 1px 0 var(--border);">
                                <tr>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Pet Name</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Type / Breed</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Owner</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Vaccine Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="p in filteredPetsList" :key="p.id">
                                    <tr style="border-bottom: 1px solid #f8fafc;">
                                        <td style="padding: 12px;">
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <img :src="p.pet_photo ? '/storage/' + p.pet_photo : 'https://ui-avatars.com/api/?name=' + encodeURIComponent(p.pet_name || 'Pet') + '&background=0E5393&color=fff'" style="width: 32px; height: 32px; border-radius: 8px; object-fit: cover; aspect-ratio: 1/1;">
                                                <div style="font-weight: 800; color: var(--text);" x-text="p.pet_name"></div>
                                            </div>
                                        </td>
                                        <td style="padding: 12px; color: var(--muted);" x-text="p.pet_type + ' (' + (p.breed || 'N/A') + ')'"></td>
                                        <td style="padding: 12px; color: var(--brand); font-weight: 700;" x-text="p.resident ? (p.resident.first_name + ' ' + p.resident.last_name) : 'N/A'"></td>
                                        <td style="padding: 12px;">
                                            <span :class="p.vaccine_status === 'Vaccinated' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700'" style="padding: 4px 10px; border-radius: 99px; font-size: 9px; font-weight: 900; text-transform: uppercase;" x-text="p.vaccine_status"></span>
                                            <div style="font-size: 8px; color: var(--light); margin-top: 2px;" x-text="'Last: ' + (p.last_vaccine_date || 'N/A')"></div>
                                        </td>
                                    </tr>
                                </template>
                                <template x-if="filteredPetsList.length === 0">
                                    <tr>
                                        <td colspan="4" style="padding: 30px; text-align: center; color: var(--light); font-weight: 600;">
                                            <i class="fas fa-paw" style="display: block; font-size: 20px; margin-bottom: 8px; opacity: 0.5;"></i>
                                            No registered pets found.
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Household List Modal --}}
        <div x-show="showHouseholdList" x-cloak class="modal-ov" x-transition @click.self="showHouseholdList=false">
            <div class="modal-box" style="max-width: 800px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico"><i class="fas fa-home"></i></div>
                            <span>Registered Households</span>
                            <span style="font-size: 11px; font-weight: 700; color: var(--muted); margin-left: 6px;" x-text="'(' + filteredHouseholdList.length + ')'"></span>
                        </div>
                        <button @click="showHouseholdList=false" class="mclose"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <div style="margin-bottom: 14px; position: relative;">
                        <input type="text" x-model="householdSearchQuery" placeholder="Search by household head, resident code, or address..." class="finput" style="width: 100%; padding-left: 32px;">
                        <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--light); font-size: 11px;"></i>
                    </div>
                    <div style="overflow-x: auto; max-height: 60vh;">
                        <table style="width:100%; border-collapse: collapse; font-size: 11px;">
                            <thead style="position: sticky; top: 0; background: #fff; z-index: 10; box-shadow: 0 1px 0 var(--border);">
                                <tr>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Household Head</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Address</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Resident Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="h in filteredHouseholdList" :key="h.id">
                                    <tr style="border-bottom: 1px solid #f8fafc; cursor: pointer;" 
                                        @click="openHouseholdMembers(h)"
                                        onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                                        <td style="padding: 12px;">
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <img :src="h.photo ? '/storage/' + h.photo : 'https://ui-avatars.com/api/?name=' + encodeURIComponent(h.first_name + '+' + h.last_name) + '&background=0E5393&color=fff'" style="width: 32px; height: 32px; border-radius: 8px; object-fit: cover;">
                                                <div>
                                                    <div style="font-weight: 800; color: var(--text);" x-text="h.first_name + ' ' + h.last_name"></div>
                                                    <div style="font-size: 9px; color: var(--brand); font-weight: 700;">Click to view family members</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 12px; color: var(--muted);" x-text="h.address"></td>
                                        <td style="padding: 12px; font-weight: 700; color: var(--brand);" x-text="h.resident_code"></td>
                                    </tr>
                                </template>
                                <template x-if="filteredHouseholdList.length === 0">
                                    <tr>
                                        <td colspan="3" style="padding: 30px; text-align: center; color: var(--light); font-weight: 600;">
                                            <i class="fas fa-home" style="display: block; font-size: 20px; margin-bottom: 8px; opacity: 0.5;"></i>
                                            No households found.
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Household Members Modal --}}
        <div x-show="showHouseholdMembersModal" x-cloak class="modal-ov" x-transition style="z-index: 1001;" @click.self="showHouseholdMembersModal=false">
            <div class="modal-box" style="max-width: 700px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico"><i class="fas fa-users"></i></div> 
                            <span x-text="'Family Members of ' + selectedHeadName"></span>
                        </div>
                        <button @click="showHouseholdMembersModal=false" class="mclose"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <div style="overflow-x: auto; max-height: 50vh;">
                        <table style="width:100%; border-collapse: collapse; font-size: 11px;">
                            <thead style="position: sticky; top: 0; background: #fff; z-index: 10; box-shadow: 0 1px 0 var(--border);">
                                <tr>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Member Name</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Relationship</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Age / Gender</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Voter Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="m in selectedMembers" :key="m.id">
                                    <tr style="border-bottom: 1px solid #f8fafc;">
                                        <td style="padding: 12px;">
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <img :src="m.photo ? '/storage/' + m.photo : 'https://ui-avatars.com/api/?name=' + encodeURIComponent((m.first_name||'') + '+' + (m.last_name||'')) + '&background=0E5393&color=fff'" style="width: 28px; height: 28px; border-radius: 6px; object-fit: cover;">
                                                <div style="font-weight: 800; color: var(--text);" x-text="(m.first_name || '') + ' ' + (m.last_name || '')"></div>
                                            </div>
                                        </td>
                                        <td style="padding: 12px;">
                                            <span style="background: rgba(14,83,147,0.1); color: var(--brand); padding: 2px 8px; border-radius: 99px; font-size: 9px; font-weight: 800;" x-text="m.relationship || 'Member'"></span>
                                        </td>
                                        <td style="padding: 12px; color: var(--muted);">
                                            <span x-text="m.age || '—'"></span> yrs • <span x-text="m.gender || '—'"></span>
                                        </td>
                                        <td style="padding: 12px;">
                                            <template x-if="m.is_voter">
                                                <span style="background: #dcfce7; color: #15803d; padding: 2px 6px; border-radius: 4px; font-size: 8px; font-weight: 900;">REGISTERED</span>
                                            </template>
                                            <template x-if="!m.is_voter">
                                                <span style="background: #f1f5f9; color: #64748b; padding: 2px 6px; border-radius: 4px; font-size: 8px; font-weight: 900;">NON-VOTER</span>
                                            </template>
                                        </td>
                                    </tr>
                                </template>
                                <template x-if="selectedMembers.length === 0">
                                    <tr>
                                        <td colspan="4" style="padding: 30px; text-align: center; color: var(--light); font-weight: 600;">
                                            <i class="fas fa-user-slash" style="display: block; font-size: 20px; margin-bottom: 8px; opacity: 0.5;"></i>
                                            No other family members found in this household.
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Issue Reports Modal --}}
        <div x-show="showIssuesList" x-cloak class="modal-ov" x-transition @click.self="showIssuesList=false">
            <div class="modal-box" style="max-width: 800px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico"><i class="fas fa-exclamation-circle"></i></div>
                            <span>Issue Reports</span>
                            <span style="font-size: 11px; font-weight: 700; color: var(--muted); margin-left: 6px;" x-text="'(' + filteredIssuesList.length + ')'"></span>
                        </div>
                        <button @click="showIssuesList=false" class="mclose"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <div style="margin-bottom: 14px; position: relative;">
                        <input type="text" x-model="issueSearchQuery" placeholder="Search by issue type, department, or complainant..." class="finput" style="width: 100%; padding-left: 32px;">
                        <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--light); font-size: 11px;"></i>
                    </div>
                    <div style="overflow-x: auto; max-height: 60vh;">
                        <table style="width:100%; border-collapse: collapse; font-size: 11px;">
                            <thead style="position: sticky; top: 0; background: #fff; z-index: 10; box-shadow: 0 1px 0 var(--border);">
                                <tr>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Issue</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Dept</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Complainant</th>
                                    <th style="padding: 12px; text-align: left; color: var(--muted); text-transform: uppercase;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="i in filteredIssuesList" :key="i.id">
                                    <tr style="border-bottom: 1px solid #f8fafc;">
                                        <td style="padding: 12px; font-weight: 800; color: var(--text);" x-text="i.issue_type"></td>
                                        <td style="padding: 12px;">
                                            <span style="background: #f1f5f9; color: #475569; padding: 2px 6px; border-radius: 4px; font-size: 8px; font-weight: 900;" x-text="i.department"></span>
                                        </td>
                                        <td style="padding: 12px; color: var(--muted);" x-text="i.complainant_name || (i.user ? (i.user.first_name + ' ' + i.user.last_name) : 'Anonymous')"></td>
                                        <td style="padding: 12px;">
                                            <span :class="{
                                                'bg-rose-100 text-rose-700': i.status === 'pending' || i.status === 'submitted',
                                                'bg-blue-100 text-blue-700': i.status === 'under_review' || i.status === 'scheduled',
                                                'bg-emerald-100 text-emerald-700': i.status === 'resolved' || i.status === 'settled'
                                            }" style="padding: 4px 10px; border-radius: 99px; font-size: 9px; font-weight: 900; text-transform: uppercase;" x-text="i.status"></span>
                                        </td>
                                    </tr>
                                </template>
                                <template x-if="filteredIssuesList.length === 0">
                                    <tr>
                                        <td colspan="4" style="padding: 30px; text-align: center; color: var(--light); font-weight: 600;">
                                            <i class="fas fa-exclamation-circle" style="display: block; font-size: 20px; margin-bottom: 8px; opacity: 0.5;"></i>
                                            No issue reports found.
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add Announcement --}}
        <div x-show="addAnnModal" x-cloak class="modal-ov" x-transition @click.self="addAnnModal=false">
            <div class="modal-box" style="max-width:560px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico"><i class="fas fa-bullhorn"></i></div> New Announcement
                        </div><button @click="addAnnModal=false" class="mclose"><i
                                class="fas fa-times-circle"></i></button>
                    </div>
                    <form action="{{ route('admin.announcements.store') }}" method="POST" enctype="multipart/form-data"
                          x-data="makePhotoUploader()">
                        @csrf
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Title *</label><input type="text" name="title" required
                                    class="finput" placeholder="e.g. Pista ng Barangay 2026"></div>
                            <div><label class="flbl">Event Date</label><input type="date" name="date" class="finput"></div>
                        </div>
                        <div class="fgrp">
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                                <label class="flbl" style="margin-bottom:0;">Photos <span style="font-size:9px;color:var(--brand);font-weight:800;">(Max 6 Photos)</span></label>
                                <span style="font-size:10px;font-weight:800;" :style="photos.length >= 6 ? 'color:var(--danger)' : 'color:var(--muted)'" x-text="photos.length + ' / 6 photos' + (photos.length >= 6 ? ' (Max)' : '')"></span>
                            </div>
                            
                            <div style="min-height:95px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);padding:10px;transition:all .2s;"
                                 @dragover.prevent="$el.style.border='2px solid #0E5393';$el.style.background='#eff6ff'"
                                 @dragleave.prevent="$el.style.border='2px dashed var(--border)';$el.style.background='#f8fafc'"
                                 @drop.prevent="$el.style.border='2px dashed var(--border)';$el.style.background='#f8fafc';addFiles($event.dataTransfer.files)">
                                 
                                <input type="file" name="images[]" multiple accept="image/*" style="display:none;" x-ref="fileInput" @change="addFiles($event.target.files)">
                                 
                                <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(75px, 1fr));gap:8px;width:100%;">
                                    <template x-for="(p, idx) in photos" :key="idx">
                                        <div style="position:relative;height:75px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border);background:#fff;box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                                            <img :src="p.url" style="width:100%;height:100%;object-fit:cover;">
                                            <span style="position:absolute;bottom:2px;left:2px;background:rgba(0,0,0,0.65);color:#fff;font-size:8px;font-weight:900;padding:1px 4px;border-radius:3px;" x-text="'#' + (idx+1)"></span>
                                            <button type="button" @click.stop="removePhoto(idx)" title="Remove Photo"
                                                    style="position:absolute;top:3px;right:3px;width:18px;height:18px;border-radius:50%;background:rgba(220,38,38,0.9);color:#fff;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:9px;line-height:1;box-shadow:0 1px 3px rgba(0,0,0,0.3);transition:.15s;"
                                                    onmouseover="this.style.transform='scale(1.15)';this.style.background='#dc2626'"
                                                    onmouseout="this.style.transform='scale(1)';this.style.background='rgba(220,38,38,0.9)'">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </template>

                                    <template x-if="photos.length < 6">
                                        <div @click="$refs.fileInput.click()"
                                             style="height:75px;border-radius:8px;background:#f8fafc;border:2px dashed #0E5393;display:flex;flex-direction:column;align-items:center;justify-content:center;cursor:pointer;transition:all .18s;gap:3px;user-select:none;"
                                             onmouseover="this.style.background='#eff6ff';this.style.borderColor='#0E5393'"
                                             onmouseout="this.style.background='#f8fafc';this.style.borderColor='#0E5393'">
                                            <div style="width:24px;height:24px;border-radius:50%;background:#0E5393;color:#fff;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:900;">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <span style="font-size:8px;font-weight:800;color:#0E5393;text-align:center;line-height:1.1;" x-text="photos.length === 0 ? 'Upload Photo' : '+' + (6 - photos.length) + ' more'"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <div class="fgrp"><label class="flbl">Tag / Category</label><select name="tag" class="finput"
                                style="appearance:none;cursor:pointer;">
                                <option>Announcement</option>
                                <option>Health</option>
                                <option>Governance</option>
                                <option>Community</option>
                                <option>Sanitation</option>
                            </select></div>
                        <div class="fgrp"><label class="flbl">Content *</label><textarea name="content" required
                                rows="4" class="finput" style="resize:vertical;"
                                placeholder="Write your announcement here..."></textarea></div>
                        <div style="display:flex;justify-content:flex-end;gap:9px;"><button type="button"
                                @click="addAnnModal=false" class="btn btn-ghost">Cancel</button><button type="submit"
                                class="btn btn-primary"><i class="fas fa-paper-plane"></i> Post Announcement</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Edit Announcement --}}
        <div x-show="editAnnModal" x-cloak class="modal-ov" x-transition @click.self="editAnnModal=false">
            <div class="modal-box" style="max-width:560px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico"><i class="fas fa-edit"></i></div> Edit Announcement
                        </div><button @click="editAnnModal=false" class="mclose"><i
                                class="fas fa-times-circle"></i></button>
                    </div>
                    <form id="editAnnForm" action="#" method="POST" enctype="multipart/form-data"
                          x-data="makePhotoUploader()">
                        @csrf @method('PUT')
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Title *</label><input type="text" name="title" required
                                    class="finput" :value="editAnn.title"></div>
                            <div><label class="flbl">Event Date</label><input type="date" name="date" class="finput" :value="editAnn.date"></div>
                        </div>
                        <div class="fgrp">
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                                <label class="flbl" style="margin-bottom:0;">Photos <span style="font-size:9px;color:var(--brand);font-weight:800;">(Max 6 Photos)</span></label>
                                <span style="font-size:10px;font-weight:800;" :style="photos.length >= 6 ? 'color:var(--danger)' : 'color:var(--muted)'" x-text="photos.length + ' / 6 photos' + (photos.length >= 6 ? ' (Max)' : '')"></span>
                            </div>
                            
                            <div style="min-height:95px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);padding:10px;transition:all .2s;"
                                 @dragover.prevent="$el.style.border='2px solid #0E5393';$el.style.background='#eff6ff'"
                                 @dragleave.prevent="$el.style.border='2px dashed var(--border)';$el.style.background='#f8fafc'"
                                 @drop.prevent="$el.style.border='2px dashed var(--border)';$el.style.background='#f8fafc';addFiles($event.dataTransfer.files)">
                                 
                                <input type="file" name="images[]" multiple accept="image/*" style="display:none;" x-ref="fileInput" @change="addFiles($event.target.files)">
                                 
                                <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(75px, 1fr));gap:8px;width:100%;">
                                    <template x-for="(p, idx) in photos" :key="idx">
                                        <div style="position:relative;height:75px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border);background:#fff;box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                                            <img :src="p.url" style="width:100%;height:100%;object-fit:cover;">
                                            <span style="position:absolute;bottom:2px;left:2px;background:rgba(0,0,0,0.65);color:#fff;font-size:8px;font-weight:900;padding:1px 4px;border-radius:3px;" x-text="'#' + (idx+1)"></span>
                                            <button type="button" @click.stop="removePhoto(idx)" title="Remove Photo"
                                                    style="position:absolute;top:3px;right:3px;width:18px;height:18px;border-radius:50%;background:rgba(220,38,38,0.9);color:#fff;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:9px;line-height:1;box-shadow:0 1px 3px rgba(0,0,0,0.3);transition:.15s;"
                                                    onmouseover="this.style.transform='scale(1.15)';this.style.background='#dc2626'"
                                                    onmouseout="this.style.transform='scale(1)';this.style.background='rgba(220,38,38,0.9)'">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </template>

                                    <template x-if="photos.length < 6">
                                        <div @click="$refs.fileInput.click()"
                                             style="height:75px;border-radius:8px;background:#f8fafc;border:2px dashed #0E5393;display:flex;flex-direction:column;align-items:center;justify-content:center;cursor:pointer;transition:all .18s;gap:3px;user-select:none;"
                                             onmouseover="this.style.background='#eff6ff';this.style.borderColor='#0E5393'"
                                             onmouseout="this.style.background='#f8fafc';this.style.borderColor='#0E5393'">
                                            <div style="width:24px;height:24px;border-radius:50%;background:#0E5393;color:#fff;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:900;">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <span style="font-size:8px;font-weight:800;color:#0E5393;text-align:center;line-height:1.1;" x-text="photos.length === 0 ? 'Upload Photo' : '+' + (6 - photos.length) + ' more'"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <div class="fgrp"><label class="flbl">Tag / Category</label><select name="tag" class="finput"
                                style="appearance:none;cursor:pointer;" x-model="editAnn.tag">
                                <option>Announcement</option>
                                <option>Health</option>
                                <option>Governance</option>
                                <option>Community</option>
                                <option>Sanitation</option>
                            </select></div>
                        <div class="fgrp"><label class="flbl">Content *</label><textarea name="content" required
                                rows="4" class="finput" style="resize:vertical;" x-model="editAnn.content"></textarea>
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:9px;"><button type="button"
                                @click="editAnnModal=false" class="btn btn-ghost">Cancel</button><button type="submit"
                                class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button></div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Add Event --}}
        <div x-show="addEvtModal" x-cloak class="modal-ov" x-transition @click.self="addEvtModal=false">
            <div class="modal-box" style="max-width:560px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico"><i class="fas fa-calendar-plus"></i></div> New Event
                        </div><button @click="addEvtModal=false" class="mclose"><i
                                class="fas fa-times-circle"></i></button>
                    </div>
                    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data"
                          x-data="makePhotoUploader()">
                        @csrf
                        <div class="fgrp"><label class="flbl">Event Title *</label><input type="text" name="title"
                                required class="finput" placeholder="e.g. Weekly Clean-Up Drive"></div>
                        <div class="fgrp">
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                                <label class="flbl" style="margin-bottom:0;">Photos <span style="font-size:9px;color:var(--brand);font-weight:800;">(Max 6 Photos)</span></label>
                                <span style="font-size:10px;font-weight:800;" :style="photos.length >= 6 ? 'color:var(--danger)' : 'color:var(--muted)'" x-text="photos.length + ' / 6 photos' + (photos.length >= 6 ? ' (Max)' : '')"></span>
                            </div>
                            
                            <div style="min-height:95px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);padding:10px;transition:all .2s;"
                                 @dragover.prevent="$el.style.border='2px solid #0E5393';$el.style.background='#eff6ff'"
                                 @dragleave.prevent="$el.style.border='2px dashed var(--border)';$el.style.background='#f8fafc'"
                                 @drop.prevent="$el.style.border='2px dashed var(--border)';$el.style.background='#f8fafc';addFiles($event.dataTransfer.files)">
                                 
                                <input type="file" name="images[]" multiple accept="image/*" style="display:none;" x-ref="fileInput" @change="addFiles($event.target.files)">
                                 
                                <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(75px, 1fr));gap:8px;width:100%;">
                                    <template x-for="(p, idx) in photos" :key="idx">
                                        <div style="position:relative;height:75px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border);background:#fff;box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                                            <img :src="p.url" style="width:100%;height:100%;object-fit:cover;">
                                            <span style="position:absolute;bottom:2px;left:2px;background:rgba(0,0,0,0.65);color:#fff;font-size:8px;font-weight:900;padding:1px 4px;border-radius:3px;" x-text="'#' + (idx+1)"></span>
                                            <button type="button" @click.stop="removePhoto(idx)" title="Remove Photo"
                                                    style="position:absolute;top:3px;right:3px;width:18px;height:18px;border-radius:50%;background:rgba(220,38,38,0.9);color:#fff;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:9px;line-height:1;box-shadow:0 1px 3px rgba(0,0,0,0.3);transition:.15s;"
                                                    onmouseover="this.style.transform='scale(1.15)';this.style.background='#dc2626'"
                                                    onmouseout="this.style.transform='scale(1)';this.style.background='rgba(220,38,38,0.9)'">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </template>

                                    <template x-if="photos.length < 6">
                                        <div @click="$refs.fileInput.click()"
                                             style="height:75px;border-radius:8px;background:#f8fafc;border:2px dashed #0E5393;display:flex;flex-direction:column;align-items:center;justify-content:center;cursor:pointer;transition:all .18s;gap:3px;user-select:none;"
                                             onmouseover="this.style.background='#eff6ff';this.style.borderColor='#0E5393'"
                                             onmouseout="this.style.background='#f8fafc';this.style.borderColor='#0E5393'">
                                            <div style="width:24px;height:24px;border-radius:50%;background:#0E5393;color:#fff;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:900;">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <span style="font-size:8px;font-weight:800;color:#0E5393;text-align:center;line-height:1.1;" x-text="photos.length === 0 ? 'Upload Photo' : '+' + (6 - photos.length) + ' more'"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <div class="fgrid2 fgrp" x-data="{addDayLabel:''}">
                            <div>
                                <label class="flbl">Day Label <span style="font-size:9px;color:var(--muted);font-weight:600;">(auto from date)</span></label>
                                <div class="finput" style="background:#f1f5f9;font-weight:900;font-size:15px;color:var(--text);text-align:center;cursor:default;letter-spacing:.05em;" x-text="addDayLabel || '--'"></div>
                                <input type="hidden" name="day_label" :value="addDayLabel" x-ref="addDayLabelInput">
                            </div>
                            <div>
                                <label class="flbl">Date *</label>
                                <input type="date" name="frequency" class="finput" required
                                    @change="const d=new Date($event.target.value+'T00:00:00');addDayLabel=['SUN','MON','TUE','WED','THU','FRI','SAT'][d.getDay()]">
                            </div>
                        </div>
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Time Range</label><input type="text" name="time_range"
                                    class="finput" placeholder="e.g. 6:00 AM – 9:00 AM"></div>
                            <div><label class="flbl">Location</label><input type="text" name="location" class="finput"
                                    placeholder="e.g. Brgy. Hall"></div>
                        </div>
                        <div class="fgrp"><label class="flbl">Tag</label><select name="tag" class="finput"
                                style="appearance:none;cursor:pointer;">
                                <option>Community</option>
                                <option>Health</option>
                                <option>Sanitation</option>
                                <option>Governance</option>
                            </select></div>
                        <div class="fgrp"><label class="flbl">Description</label><textarea name="description" rows="2"
                                class="finput" style="resize:vertical;" placeholder="Optional details..."></textarea>
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:9px;"><button type="button"
                                @click="addEvtModal=false" class="btn btn-ghost">Cancel</button><button type="submit"
                                class="btn btn-primary"><i class="fas fa-save"></i> Save Event</button></div>
                    </form>
                </div>
            </div>
        </div>



        {{-- Add Project Modal --}}
        <div x-show="addProjModal" x-cloak class="modal-ov" x-transition @click.self="addProjModal=false">
            <div class="modal-box" style="max-width:580px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico" style="background:#eff6ff;color:#0E5393;"><i class="fas fa-hammer"></i></div> New Barangay Project
                        </div>
                        <button type="button" @click="addProjModal=false" class="mclose"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data"
                          x-data="makePhotoUploader()">
                        @csrf
                        <div class="fgrp">
                            <label class="flbl">Project Title *</label>
                            <input type="text" name="title" required class="finput" placeholder="e.g. Drainage Rehabilitation Phase 2">
                        </div>

                        {{-- Multi-photo upload (up to 6) --}}
                        <div class="fgrp">
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                                <label class="flbl" style="margin-bottom:0;">Project Photos <span style="font-size:9px;color:var(--brand);font-weight:800;">(Max 6 Photos)</span></label>
                                <span style="font-size:10px;font-weight:800;" :style="photos.length >= 6 ? 'color:var(--danger)' : 'color:var(--muted)'" x-text="photos.length + ' / 6 photos'"></span>
                            </div>
                            <div style="min-height:95px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);padding:10px;"
                                 @dragover.prevent="$el.style.border='2px solid #0E5393';$el.style.background='#eff6ff'"
                                 @dragleave.prevent="$el.style.border='2px dashed var(--border)';$el.style.background='#f8fafc'"
                                 @drop.prevent="$el.style.border='2px dashed var(--border)';$el.style.background='#f8fafc';addFiles($event.dataTransfer.files)">
                                
                                <input type="file" name="images[]" multiple accept="image/*" style="display:none;" x-ref="fileInput" @change="addFiles($event.target.files)">
                                
                                <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(75px, 1fr));gap:8px;width:100%;">
                                    <template x-for="(p, idx) in photos" :key="idx">
                                        <div style="position:relative;height:75px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border);background:#fff;">
                                            <img :src="p.url" style="width:100%;height:100%;object-fit:cover;">
                                            <span style="position:absolute;bottom:2px;left:2px;background:rgba(0,0,0,0.65);color:#fff;font-size:8px;font-weight:900;padding:1px 4px;border-radius:3px;" x-text="'#' + (idx+1)"></span>
                                            <button type="button" @click.stop="removePhoto(idx)"
                                                    style="position:absolute;top:3px;right:3px;width:18px;height:18px;border-radius:50%;background:rgba(220,38,38,0.9);color:#fff;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:9px;">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </template>
                                    <template x-if="photos.length < 6">
                                        <div @click="$refs.fileInput.click()"
                                             style="height:75px;border-radius:8px;background:#f8fafc;border:2px dashed #0E5393;display:flex;flex-direction:column;align-items:center;justify-content:center;cursor:pointer;gap:3px;">
                                            <div style="width:24px;height:24px;border-radius:50%;background:#0E5393;color:#fff;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:900;">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <span style="font-size:8px;font-weight:800;color:#0E5393;" x-text="photos.length === 0 ? 'Upload Photo' : '+' + (6 - photos.length) + ' more'"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div class="fgrid2 fgrp">
                            <div>
                                <label class="flbl">Category</label>
                                <select name="category" class="finput">
                                    <option value="Infrastructure">Infrastructure</option>
                                    <option value="Roads & Drainage">Roads & Drainage</option>
                                    <option value="Health & Sanitation">Health & Sanitation</option>
                                    <option value="Peace & Security">Peace & Security</option>
                                    <option value="Livelihood & Training">Livelihood & Training</option>
                                    <option value="Youth & Sports">Youth & Sports</option>
                                    <option value="Environmental">Environmental</option>
                                    <option value="General" selected>General</option>
                                </select>
                            </div>
                            <div>
                                <label class="flbl">Status *</label>
                                <select name="status" class="finput" required>
                                    <option value="planning">Planning</option>
                                    <option value="in_progress" selected>In Progress</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                        </div>

                        <div class="fgrid2 fgrp">
                            <div>
                                <label class="flbl">Estimated Start Date</label>
                                <input type="date" name="start_date" class="finput">
                            </div>
                            <div>
                                <label class="flbl">Estimated Completion Date</label>
                                <input type="date" name="completion_date" class="finput">
                            </div>
                        </div>

                        <div class="fgrid2 fgrp">
                            <div>
                                <label class="flbl">Allocated Budget (₱)</label>
                                <input type="number" step="0.01" name="budget" class="finput" placeholder="e.g. 500000">
                            </div>
                            <div>
                                <label class="flbl">Project Lead / Contractor</label>
                                <input type="text" name="contractor_lead" class="finput" placeholder="e.g. Engr. Dela Cruz / ABC Corp">
                            </div>
                        </div>

                        <div class="fgrp">
                            <label class="flbl">Project Description & Scope</label>
                            <textarea name="description" rows="3" class="finput" style="resize:vertical;" placeholder="Describe project goals, timeline, and community impact..."></textarea>
                        </div>

                        <div style="display:flex;justify-content:flex-end;gap:9px;">
                            <button type="button" @click="addProjModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Project</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Add Official --}}
        <div x-show="addOffModal" x-cloak class="modal-ov" x-transition @click.self="addOffModal=false">
            <div class="modal-box">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="mico"><i class="fas fa-user-tie"></i></div> Add New Official
                        </div><button @click="addOffModal=false" class="mclose"><i
                                class="fas fa-times-circle"></i></button>
                    </div>
                    <form action="{{ route('admin.officials.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="fgrp"><label class="flbl">Official Photo</label>
                            <label style="cursor:pointer;display:block;"
                                @dragover.prevent="$refs.dz6.style.border='2px solid #0E5393';$refs.dz6.style.background='#f1f5f9'"
                                @dragleave.prevent="$refs.dz6.style.border='2px dashed var(--border)';$refs.dz6.style.background='#f8fafc'"
                                @drop.prevent="const f=$event.dataTransfer.files[0];if(f){$refs.file6.files=$event.dataTransfer.files;const r=new FileReader();r.onload=e=>photoPreview=e.target.result;r.readAsDataURL(f);$refs.dz6.style.border='2px dashed var(--border)';$refs.dz6.style.background='#f8fafc'}">
                                <div x-ref="dz6" style="width:160px;height:160px;border-radius:12px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;transition:all .2s;margin:0 auto;" :style="photoPreview?'border:2px solid #0E5393':''" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                                    <img x-show="photoPreview" :src="photoPreview" style="width:100%;height:100%;object-fit:cover;background:#f8fafc;aspect-ratio:1/1;">
                                    <div x-show="!photoPreview" style="text-align:center;"><i class="fas fa-id-badge" style="font-size:24px;color:var(--light);margin-bottom:6px;"></i><div style="font-size:10px;font-weight:800;color:var(--muted);text-transform:uppercase;">Upload</div></div>
                                </div>
                                <input type="file" name="photo" accept="image/*" style="display:none;" x-ref="file6" @change="const f=$event.target.files[0];if(f){const r=new FileReader();r.onload=e=>photoPreview=e.target.result;r.readAsDataURL(f)}">
                            </label>
                        </div>
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Full Name *</label><input type="text" name="name" required
                                    class="finput" placeholder="Hon. Juan Dela Cruz"></div>
                            <div><label class="flbl">Position *</label><input type="text" name="position"
                                    class="finput" placeholder="e.g. Punong Barangay" required></div>
                        </div>
                        <div class="fgrp">
                            <label class="flbl">Department *</label>
                            <select name="department" class="finput" required>
                                <option value="">None</option>
                                <option value="Peace">Peace</option>
                                <option value="VAWC">VAWC</option>
                                <option value="Justice">Justice</option>
                                <option value="Office">Office</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Term Start</label><input type="date" name="term_start"
                                    class="finput"></div>
                            <div><label class="flbl">Term End</label><input type="date" name="term_end" class="finput">
                            </div>
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:9px;"><button type="button"
                                @click="addOffModal=false" class="btn btn-ghost">Cancel</button><button type="submit"
                                class="btn btn-primary"><i class="fas fa-save"></i> Save Official</button></div>
                    </form>
                </div>
            </div>
        </div>





        {{-- Add Carousel Slide --}}
        <div x-show="addSlideModal" x-cloak class="modal-ov" x-transition @click.self="addSlideModal=false">
            <div class="modal-box">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl"><div class="mico"><i class="fas fa-plus"></i></div> Add Carousel Slide</div>
                        <button @click="addSlideModal=false" class="mclose"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="fgrp"><label class="flbl">Slide Image *</label>
                            <label style="cursor:pointer;display:block;"
                                @dragover.prevent="$refs.dz7.style.border='2px solid #0E5393';$refs.dz7.style.background='#f1f5f9'"
                                @dragleave.prevent="$refs.dz7.style.border='2px dashed var(--border)';$refs.dz7.style.background='#f8fafc'"
                                @drop.prevent="const f=$event.dataTransfer.files[0];if(f){$refs.file7.files=$event.dataTransfer.files;const r=new FileReader();r.onload=e=>slidePhotoPreview=e.target.result;r.readAsDataURL(f);$refs.dz7.style.border='2px dashed var(--border)';$refs.dz7.style.background='#f8fafc'}">
                                <div x-ref="dz7" style="height:150px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;transition:all .2s;" :style="slidePhotoPreview?'border:2px solid #0E5393':''" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                                    <img x-show="slidePhotoPreview" :src="slidePhotoPreview" style="width:100%;height:100%;object-fit:contain;">
                                    <div x-show="!slidePhotoPreview" style="text-align:center;"><i class="fas fa-image" style="font-size:24px;color:var(--light);margin-bottom:6px;"></i><div style="font-size:11px;font-weight:800;color:var(--muted);text-transform:uppercase;">Upload Photo</div><div style="font-size:9px;font-weight:600;color:var(--light);">Click or Drag & Drop</div></div>
                                </div>
                                <input type="file" name="image" accept="image/*" style="display:none;" x-ref="file7" required @change="const f=$event.target.files[0];if(f){const r=new FileReader();r.onload=e=>slidePhotoPreview=e.target.result;r.readAsDataURL(f)}">
                            </label>
                        </div>
                        <div class="fgrp"><label class="flbl">Title (Optional)</label><input type="text" name="title" class="finput" placeholder="e.g. Welcome to Barangay San Miguel II"></div>
                        <div style="display:flex;justify-content:flex-end;gap:9px;"><button type="button" @click="addSlideModal=false" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-primary">Save Slide</button></div>
                    </form>
                </div>
            </div>
        </div>


        {{-- ══ DEPARTMENT REPORT VIEW POP-UP MODAL ══ --}}
        <div x-show="viewReportModal" x-cloak class="modal-ov" style="z-index: 9998;" x-transition @click.self="closeReportModal()">
            <div class="modal-box" style="max-width: 1060px; width: 96vw; max-height: 92vh; display: flex; flex-direction: column; overflow: hidden; padding: 0; border-radius: 16px; box-shadow: 0 25px 60px rgba(0,0,82,0.35); border: none;">
                
                {{-- MODAL HEADER BAR --}}
                <div style="background: linear-gradient(135deg, #000052 0%, #0E5393 100%); padding: 14px 20px; display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; flex-shrink: 0;">
                    <div style="display: flex; align-items: center; gap: 10px; min-width: 0;">
                        <div style="width: 34px; height: 34px; border-radius: 8px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 15px; flex-shrink: 0;">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div style="min-width: 0;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span style="font-size: 10px; font-weight: 900; background: rgba(255,255,255,0.2); color: #fff; padding: 2px 8px; border-radius: 99px; text-transform: uppercase;" x-text="activeReport?.department || 'Department'"></span>
                                <span style="font-size: 10px; font-weight: 700; color: rgba(255,255,255,0.8);" x-text="activeReport?.reporting_period || ''"></span>
                            </div>
                            <div style="font-size: 13px; font-weight: 900; color: #fff; margin-top: 2px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap; max-width: 500px;" x-text="activeReport?.report_title || 'Report View'"></div>
                        </div>
                    </div>

                    {{-- ACTION TOOLBAR --}}
                    <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                        {{-- DOWNLOAD PDF --}}
                        <button type="button" @click="downloadActiveReportPdf()" class="btn btn-sm" style="background: #10b981; color: #fff; border: none; border-radius: 8px; padding: 7px 14px; font-weight: 800; font-size: 11px; display: inline-flex; align-items: center; gap: 6px; cursor: pointer; transition: all .15s; box-shadow: 0 2px 8px rgba(16,185,129,0.3);">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </button>

                        {{-- PRINT (NEW TAB) --}}
                        <button type="button" @click="printReportNewTab()" class="btn btn-sm" style="background: #3b82f6; color: #fff; border: none; border-radius: 8px; padding: 7px 14px; font-weight: 800; font-size: 11px; display: inline-flex; align-items: center; gap: 6px; cursor: pointer; transition: all .15s; box-shadow: 0 2px 8px rgba(59,130,246,0.3);">
                            <i class="fas fa-print"></i> Print (New Tab)
                        </button>

                        {{-- ATTACHED FILE IF AVAILABLE --}}
                        <template x-if="activeReport?.template_file">
                            <a :href="'/storage/' + activeReport.template_file" target="_blank" class="btn btn-sm" style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3); border-radius: 8px; padding: 7px 12px; font-size: 11px; text-decoration: none; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="fas fa-paperclip"></i> Attached Format
                            </a>
                        </template>

                        {{-- CLOSE BUTTON --}}
                        <button type="button" @click="closeReportModal()" style="background: rgba(255,255,255,0.15); border: none; color: #fff; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 13px; margin-left: 6px; transition: background .15s;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                {{-- MODAL BODY / DOCUMENT PAPER PREVIEW --}}
                <div style="flex: 1; overflow-y: auto; background: #e2e8f0; padding: 24px;">
                    <div id="report-modal-paper" style="background: #fff; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); padding: 28px; font-family: 'Times New Roman', serif; min-width: 820px; max-width: 980px; margin: 0 auto; color: #000;">
                        
                        {{-- Official Header with 3 Logos --}}
                        <div style="text-align: center; margin-bottom: 14px;">
                            <div style="display: flex; align-items: center; justify-content: center; gap: 28px; margin-bottom: 8px;">
                                <img src="{{ asset('images/dasma.png') }}" style="width: 64px; height: 64px; object-fit: contain;" alt="City of Dasmariñas">
                                <img src="{{ asset('images/Bagong_Pilipinas_logo.png') }}" style="width: 64px; height: 64px; object-fit: contain;" alt="Bagong Pilipinas">
                                <img src="{{ asset('images/circlelogo.png') }}" style="width: 64px; height: 64px; object-fit: contain;" alt="Barangay SM2">
                            </div>
                            <div style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.18em; font-weight: bold;">
                                REPUBLIC OF THE PHILIPPINES
                            </div>
                            <div style="font-size: 11.5px; text-transform: uppercase; letter-spacing: 0.12em; font-weight: bold;">
                                PROVINCE OF CAVITE
                            </div>
                            <div style="font-size: 11.5px; text-transform: uppercase; letter-spacing: 0.12em; font-weight: bold;">
                                CITY OF DASMARIÑAS
                            </div>
                            <div style="font-size: 11.5px; text-transform: uppercase; letter-spacing: 0.12em; font-weight: bold;">
                                BARANGAY SAN MIGUEL 2
                            </div>
                            <div style="font-size: 12px; text-transform: uppercase; font-weight: bold; margin-top: 3px; letter-spacing: 0.06em;">
                                <template x-if="activeReport?.department === 'VAWC'"><span>BARANGAY VAW DESK</span></template>
                                <template x-if="activeReport?.department === 'Peace & Order'"><span>COMMITTEE ON PEACE AND ORDER & PUBLIC SAFETY</span></template>
                                <template x-if="activeReport?.department === 'Justice'"><span>OFFICE OF THE LUPON TAGAPAMAYAPA</span></template>
                                <template x-if="activeReport?.department === 'Office'"><span>OFFICE OF THE BARANGAY SECRETARY & CIVIL REGISTRY</span></template>
                            </div>
                            <div style="border-bottom: 1.5px solid #000; width: 100%; margin: 8px auto 14px;"></div>

                            <div style="font-size: 13px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.04em;">
                                Office of the Punong Barangay
                            </div>
                            <div style="font-size: 12.5px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.04em; margin-top: 2px;" x-text="activeReport?.report_title"></div>
                            <div style="font-size: 11.5px; font-weight: bold; text-transform: uppercase; margin-top: 3px;" x-text="'FOR THE MONTH OF ' + (activeReport?.reporting_period || '')"></div>
                        </div>

                        {{-- Sub Meta Top-Left --}}
                        <div style="font-size: 11px; margin-bottom: 10px; line-height: 1.4;">
                            <div><strong>Province:</strong> <span x-text="activeReportData?.province || 'Cavite'"></span></div>
                            <div><strong>City:</strong> <span x-text="activeReportData?.city || 'Dasmariñas'"></span></div>
                            <div><strong>Barangay:</strong> <span x-text="activeReportData?.barangay || 'San Miguel 2'"></span></div>
                        </div>

                        {{-- VAWC MATRIX TABLE --}}
                        <template x-if="activeReport?.department === 'VAWC'">
                            <div style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse; font-size: 10px; text-align: center; border: 1.5px solid #000;">
                                    <thead>
                                        <tr style="background: #f8fafc;">
                                            <th rowspan="2" style="border: 1px solid #000; padding: 6px 3px; font-size: 9.5px; vertical-align: middle; width: 9%;">Presence of Barangay VAWC DESK</th>
                                            <th colspan="2" style="border: 1px solid #000; padding: 6px 3px; font-size: 9.5px; vertical-align: middle; width: 17%;">Source of Fund for VAWC DESK Operation</th>
                                            <th rowspan="2" style="border: 1px solid #000; padding: 6px 3px; font-size: 9.5px; vertical-align: middle; width: 11%;">Presence of Logbook for VAWC Desk Purposes only</th>
                                            <th rowspan="2" style="border: 1px solid #000; padding: 6px 3px; font-size: 9.5px; vertical-align: middle; width: 9%;">No. of VAWC Cases Handled by the Barangay</th>
                                            <th colspan="5" style="border: 1px solid #000; padding: 6px 3px; font-size: 9.5px; vertical-align: middle; width: 27%;">No. of VAWC Victims</th>
                                            <th colspan="5" style="border: 1px solid #000; padding: 6px 3px; font-size: 9.5px; vertical-align: middle; width: 27%;">No. of CASES ACTED UPON</th>
                                        </tr>
                                        <tr style="background: #f1f5f9;">
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">5% GAD Fund</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Other Source of Fund (BCPC)</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Physical Abuse</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Economic Abuse</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Sexual Abuse</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Psychological Abuse</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold; background: #e2e8f0;">TOTAL</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Referred to PNP</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Referred to Court</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Issued BPOs</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Referred to Medical</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold; background: #e2e8f0;">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="height: 44px; background: #fff;">
                                            <td style="border: 1px solid #000; padding: 4px; font-weight: bold;" x-text="activeReportData?.hasDesk || 'YES'"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.gadFund || '70,500.00'"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.bcpcFund || '52,194.00'"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.hasLogbook || 'Yes'"></td>
                                            <td style="border: 1px solid #000; padding: 4px; font-weight: bold;" x-text="activeReportData?.casesHandled || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.physicalAbuse || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.economicAbuse || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.sexualAbuse || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.psychAbuse || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px; font-weight: bold; background: #f8fafc;" x-text="(Number(activeReportData?.physicalAbuse||0) + Number(activeReportData?.economicAbuse||0) + Number(activeReportData?.sexualAbuse||0) + Number(activeReportData?.psychAbuse||0))"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.referredPnp || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.referredCourt || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.issuedBpo || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.referredMedical || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px; font-weight: bold; background: #f8fafc;" x-text="(Number(activeReportData?.referredPnp||0) + Number(activeReportData?.referredCourt||0) + Number(activeReportData?.issuedBpo||0) + Number(activeReportData?.referredMedical||0))"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </template>

                        {{-- PEACE & ORDER MATRIX TABLE --}}
                        <template x-if="activeReport?.department === 'Peace & Order'">
                            <div style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse; font-size: 10px; text-align: center; border: 1.5px solid #000;">
                                    <thead>
                                        <tr style="background: #f8fafc;">
                                            <th colspan="3" style="border: 1px solid #000; padding: 6px 3px; font-size: 9.5px; vertical-align: middle; width: 25%;">Security Desk & Tanod Force</th>
                                            <th colspan="6" style="border: 1px solid #000; padding: 6px 3px; font-size: 9.5px; vertical-align: middle; width: 45%;">Blotter Incidents Logged</th>
                                            <th colspan="5" style="border: 1px solid #000; padding: 6px 3px; font-size: 9.5px; vertical-align: middle; width: 30%;">Actions Taken & Resolutions</th>
                                        </tr>
                                        <tr style="background: #f1f5f9;">
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Presence of Desk</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Tanod Logbook</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Tanods on Duty</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Vehicular Accidents</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Noise Disturbance</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Theft / Robbery</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Physical Injuries</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Other Cases</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold; background: #e2e8f0;">TOTAL</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Settled at Desk</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Escalated to KP</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Referred to PNP</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Transferred VAWC</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold; background: #e2e8f0;">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="height: 44px; background: #fff;">
                                            <td style="border: 1px solid #000; padding: 4px; font-weight: bold;" x-text="activeReportData?.hasDesk || 'YES'"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.hasLogbook || 'Yes'"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.tanodsOnDuty || 12"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.vehicularAccidents || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.noiseDisturbance || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.theftRobbery || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.physicalInjuries || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.otherIncidents || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px; font-weight: bold; background: #f8fafc;" x-text="(Number(activeReportData?.vehicularAccidents||0) + Number(activeReportData?.noiseDisturbance||0) + Number(activeReportData?.theftRobbery||0) + Number(activeReportData?.physicalInjuries||0) + Number(activeReportData?.otherIncidents||0))"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.settledAtDesk || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.escalatedJustice || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.referredPnp || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.transferredVawc || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px; font-weight: bold; background: #f8fafc;" x-text="(Number(activeReportData?.settledAtDesk||0) + Number(activeReportData?.escalatedJustice||0) + Number(activeReportData?.referredPnp||0) + Number(activeReportData?.transferredVawc||0))"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </template>

                        {{-- JUSTICE MATRIX TABLE --}}
                        <template x-if="activeReport?.department === 'Justice'">
                            <div style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse; font-size: 10px; text-align: center; border: 1.5px solid #000;">
                                    <thead>
                                        <tr style="background: #f8fafc;">
                                            <th colspan="4" style="border: 1px solid #000; padding: 6px 3px; font-size: 9.5px; vertical-align: middle; width: 34%;">Nature of Disputes / Cases Received</th>
                                            <th colspan="4" style="border: 1px solid #000; padding: 6px 3px; font-size: 9.5px; vertical-align: middle; width: 33%;">Settled Disputes</th>
                                            <th colspan="5" style="border: 1px solid #000; padding: 6px 3px; font-size: 9.5px; vertical-align: middle; width: 33%;">Unsettled & Other Dispositions</th>
                                        </tr>
                                        <tr style="background: #f1f5f9;">
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Criminal Cases</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Civil Cases</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Other Disputes</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold; background: #e2e8f0;">TOTAL</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Mediation (PB)</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Conciliation (Pangkat)</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Arbitration</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold; background: #e2e8f0;">TOTAL</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Withdrawn</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Repudiated</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">CFA (Court Action)</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Pending</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold; background: #e2e8f0;">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="height: 44px; background: #fff;">
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.criminalCases || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.civilCases || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.othersCases || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px; font-weight: bold; background: #f8fafc;" x-text="(Number(activeReportData?.criminalCases||0) + Number(activeReportData?.civilCases||0) + Number(activeReportData?.othersCases||0))"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.settledMediation || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.settledConciliation || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.settledArbitration || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px; font-weight: bold; background: #f8fafc;" x-text="(Number(activeReportData?.settledMediation||0) + Number(activeReportData?.settledConciliation||0) + Number(activeReportData?.settledArbitration||0))"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.withdrawnCases || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.repudiatedCases || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.certToCourt || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.pendingCases || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px; font-weight: bold; background: #f8fafc;" x-text="(Number(activeReportData?.withdrawnCases||0) + Number(activeReportData?.repudiatedCases||0) + Number(activeReportData?.certToCourt||0) + Number(activeReportData?.pendingCases||0))"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </template>

                        {{-- OFFICE MATRIX TABLE --}}
                        <template x-if="activeReport?.department === 'Office'">
                            <div style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse; font-size: 10px; text-align: center; border: 1.5px solid #000;">
                                    <thead>
                                        <tr style="background: #f8fafc;">
                                            <th colspan="6" style="border: 1px solid #000; padding: 6px 3px; font-size: 9.5px; vertical-align: middle; width: 45%;">Resident Registry & Special Sectors</th>
                                            <th colspan="6" style="border: 1px solid #000; padding: 6px 3px; font-size: 9.5px; vertical-align: middle; width: 40%;">Document Requests & Issuance</th>
                                            <th colspan="2" style="border: 1px solid #000; padding: 6px 3px; font-size: 9.5px; vertical-align: middle; width: 15%;">Digital & Welfare</th>
                                        </tr>
                                        <tr style="background: #f1f5f9;">
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Total Residents</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">New This Month</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Seniors (60+)</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">PWDs</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Solo Parents</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Voters</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Brgy Clearance</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Indigency</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Residency</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Business Clear.</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Jobseeker</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold; background: #e2e8f0;">TOTAL DOCS</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Digital IDs</th>
                                            <th style="border: 1px solid #000; padding: 4px 2px; font-size: 9px; font-weight: bold;">Registered Pets</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="height: 44px; background: #fff;">
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.totalResidents || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.newResidentsMonth || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.seniorCount || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.pwdCount || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.soloParentCount || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.votersCount || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.clearanceIssued || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.indigencyIssued || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.residencyIssued || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.businessClearanceIssued || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.firstTimeJobseekerIssued || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px; font-weight: bold; background: #f8fafc;" x-text="(Number(activeReportData?.clearanceIssued||0) + Number(activeReportData?.indigencyIssued||0) + Number(activeReportData?.residencyIssued||0) + Number(activeReportData?.businessClearanceIssued||0) + Number(activeReportData?.firstTimeJobseekerIssued||0))"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.digitalIdIssued || 0"></td>
                                            <td style="border: 1px solid #000; padding: 4px;" x-text="activeReportData?.registeredPets || 0"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </template>

                        {{-- Signatures Footer --}}
                        <div style="margin-top: 40px; display: flex; justify-content: space-between; align-items: flex-start; padding: 0 24px;">
                            <div style="width: 240px; text-align: left;">
                                <div style="font-size: 11px;">Prepared by :</div>
                                <div style="margin-top: 35px; border-bottom: 1.5px solid #000; padding-bottom: 2px; font-weight: bold; font-size: 11.5px; text-transform: uppercase; text-align: center;" x-text="activeReportData?.preparedBy || activeReport?.submitted_by || 'Department Officer'"></div>
                                <div style="text-align: center; margin-top: 2px; font-size: 10.5px;" x-text="activeReportData?.preparedRole || activeReport?.submitted_role || 'Officer In-Charge'"></div>
                            </div>

                            <div style="width: 240px; text-align: left;">
                                <div style="font-size: 11px;">Noted by:</div>
                                <div style="margin-top: 35px; border-bottom: 1.5px solid #000; padding-bottom: 2px; font-weight: bold; font-size: 11.5px; text-transform: uppercase; text-align: center;" x-text="activeReportData?.notedBy || 'MARVIN M. BENIS'"></div>
                                <div style="text-align: center; margin-top: 2px; font-size: 10.5px;" x-text="activeReportData?.notedRole || 'Punong Barangay'"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ CUSTOM CONFIRM MODAL ══ --}}
        <div x-show="confirmModal.show" x-cloak class="modal-ov" style="z-index: 9999;" x-transition @click.self="confirmModal.show = false">
            <div class="modal-box" style="max-width: 380px; text-align: center; border-bottom: none;">
                <div class="modal-in">
                    <div style="margin-bottom: 24px;">
                        <div style="width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px;" :style="confirmModal.type === 'danger' ? 'background: rgba(220, 38, 38, 0.1);' : 'background: rgba(14, 83, 147, 0.1);'">
                            <i class="fas" :class="confirmModal.type === 'danger' ? 'fa-exclamation-triangle' : 'fa-info-circle'" :style="confirmModal.type === 'danger' ? 'color: #dc2626; font-size: 28px;' : 'color: #0E5393; font-size: 28px;'"></i>
                        </div>
                        <h3 style="font-size: 18px; font-weight: 900; color: var(--text); margin-bottom: 10px;" x-text="confirmModal.title"></h3>
                        <p style="font-size: 13px; color: var(--muted); font-weight: 600; line-height: 1.6; padding: 0 10px;" x-text="confirmModal.message"></p>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <button @click="confirmModal.show = false" class="btn btn-ghost" style="padding: 12px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">CANCEL</button>
                        <button @click="executeConfirm()" class="btn" :class="confirmModal.type === 'danger' ? 'btn-danger' : 'btn-primary'" style="padding: 12px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;" x-text="confirmModal.confirmText"></button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ EDIT STAFF SECURITY Q&A MODAL ══ --}}
        <div x-show="editStaffSecurityModal" x-cloak class="modal-ov" style="z-index: 9999;" x-transition @click.self="editStaffSecurityModal=false">
            <div class="modal-box" style="max-width:540px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl" style="display:flex;align-items:center;gap:10px;">
                            <div class="mico" style="background:linear-gradient(135deg,#0E5393 0%,#000052 100%);color:#fff;">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <div>
                                <span style="font-size:14px;font-weight:900;">Update Account & Security</span>
                                <div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:1px;" x-text="'Managing ' + (staffSecurityData.role || '').toUpperCase() + ' Portal Access'"></div>
                            </div>
                        </div>
                        <button type="button" @click="editStaffSecurityModal=false" class="mclose"><i class="fas fa-times-circle"></i></button>
                    </div>

                    <form action="{{ route('admin.staff-security.update') }}" method="POST" style="margin-top:14px;">
                        @csrf
                        <input type="hidden" name="user_id" :value="staffSecurityData.user_id">

                        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));gap:12px;margin-bottom:16px;">
                            <div>
                                <label class="flbl">Officer In-Charge / Name *</label>
                                <input type="text" name="name" x-model="staffSecurityData.name" required class="finput" style="width:100%;font-weight:700;" placeholder="e.g. Maria Teresa Ramos">
                            </div>
                            <div>
                                <label class="flbl">Registered Official Email (Gmail) *</label>
                                <input type="email" name="email" x-model="staffSecurityData.email" required class="finput" style="width:100%;font-weight:700;" placeholder="e.g. brgy.sm2.office@gmail.com">
                            </div>
                        </div>

                        <div class="fgrp" style="margin-bottom:16px;">
                            <label class="flbl">Security Question Preset</label>
                            <select x-model="staffSecurityData.question_preset" @change="
                                if (staffSecurityData.question_preset !== 'custom') {
                                    staffSecurityData.security_question = staffSecurityData.question_preset;
                                }
                            " class="finput" style="width:100%;font-weight:700;">
                                <option value="What is the Barangay Station Code?">What is the Barangay Station Code? (Default)</option>
                                <option value="What is your first pet's name?">What is your first pet's name?</option>
                                <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                                <option value="What was your childhood nickname?">What was your childhood nickname?</option>
                                <option value="What is the official Barangay Emergency Hotline?">What is the official Barangay Emergency Hotline?</option>
                                <option value="custom">✏️ Enter Custom Question...</option>
                            </select>
                        </div>

                        <div class="fgrp" style="margin-bottom:16px;" x-show="staffSecurityData.question_preset === 'custom'">
                            <label class="flbl">Custom Security Question *</label>
                            <input type="text" name="security_question" x-model="staffSecurityData.security_question" required class="finput" style="width:100%;" placeholder="e.g. What is the name of your first elementary school?">
                        </div>

                        <template x-if="staffSecurityData.question_preset !== 'custom'">
                            <input type="hidden" name="security_question" :value="staffSecurityData.security_question">
                        </template>

                        <div class="fgrp" style="margin-bottom:16px;">
                            <label class="flbl" style="display:flex;justify-content:space-between;align-items:center;">
                                <span>Security Answer (Secret Verification Answer) *</span>
                                <span style="font-size:9px;color:var(--brand);font-weight:800;text-transform:none;">Not case-sensitive</span>
                            </label>
                            <div style="position:relative;">
                                <input :type="staffSecurityData.show_answer ? 'text' : 'password'" name="security_answer" x-model="staffSecurityData.security_answer" required class="finput" style="width:100%;padding-right:40px;font-weight:700;" placeholder="e.g. BRGY-2026">
                                <button type="button" @click="staffSecurityData.show_answer = !staffSecurityData.show_answer" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);border:none;background:none;color:#64748b;cursor:pointer;outline:none;" :title="staffSecurityData.show_answer ? 'Hide' : 'Reveal'">
                                    <i class="fas" :class="staffSecurityData.show_answer ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                            <div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:6px;line-height:1.4;">
                                💡 Tip: The official can type this answer in uppercase or lowercase (e.g. <code>BRGY-2026</code>, <code>brgy-2026</code>, etc.).
                            </div>
                        </div>

                        <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:22px;padding-top:14px;border-top:1px solid var(--border);">
                            <button type="button" @click="editStaffSecurityModal=false" class="btn btn-ghost" style="padding:10px 16px;">Cancel</button>
                            <button type="submit" class="btn btn-primary" style="background:var(--btn-grad);color:#fff;border:none;padding:10px 20px;border-radius:10px;font-weight:800;">
                                <i class="fas fa-check-circle"></i> Save Account & Security Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        async function downloadReport() {
            const btn = document.querySelector('[onclick="downloadReport()"]');
            const origHtml = btn ? btn.innerHTML : '';
            if (btn) { btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generating...'; btn.disabled = true; }

            try {
                const { jsPDF } = window.jspdf;
                const el = document.getElementById('print-report');
                if (!el) return;

                // Temporarily show element fully for capture
                el.style.maxHeight = 'none';
                el.style.overflow = 'visible';

                const canvas = await html2canvas(el, {
                    scale: 2,
                    useCORS: true,
                    allowTaint: true,
                    backgroundColor: '#ffffff',
                    logging: false,
                    width: el.scrollWidth,
                    height: el.scrollHeight,
                    windowWidth: 1200
                });

                el.style.maxHeight = '';
                el.style.overflow = '';

                const imgData = canvas.toDataURL('image/jpeg', 0.95);
                const isLandscape = !!document.querySelector('.vawc-landscape-view');
                const pdf = new jsPDF({ orientation: isLandscape ? 'landscape' : 'portrait', unit: 'mm', format: 'a4' });

                const pageW = pdf.internal.pageSize.getWidth();
                const pageH = pdf.internal.pageSize.getHeight();
                const margin = 12;
                const contentW = pageW - margin * 2;
                const imgH = (canvas.height * contentW) / canvas.width;

                let yPos = margin;
                let remaining = imgH;

                // Slice image across multiple pages if needed
                const pageContentH = pageH - margin * 2;
                while (remaining > 0) {
                    const sliceH = Math.min(remaining, pageContentH);
                    const srcY = (imgH - remaining) * (canvas.height / imgH);
                    const srcH = sliceH * (canvas.height / imgH);

                    // Create a temporary canvas for the slice
                    const sliceCanvas = document.createElement('canvas');
                    sliceCanvas.width = canvas.width;
                    sliceCanvas.height = srcH;
                    const ctx = sliceCanvas.getContext('2d');
                    ctx.drawImage(canvas, 0, srcY, canvas.width, srcH, 0, 0, canvas.width, srcH);
                    const sliceData = sliceCanvas.toDataURL('image/jpeg', 0.95);

                    pdf.addImage(sliceData, 'JPEG', margin, yPos, contentW, sliceH);
                    remaining -= sliceH;
                    if (remaining > 0) { pdf.addPage(); yPos = margin; }
                }

                pdf.save('Barangay_SM2_Report_{{ now()->format("Y-m-d") }}.pdf');
            } catch (err) {
                console.error('PDF error:', err);
                alert('Download failed. Please use Print > Save as PDF instead.');
            } finally {
                if (btn) { btn.innerHTML = origHtml; btn.disabled = false; }
            }
        }
    </script>

</body>

</html>
