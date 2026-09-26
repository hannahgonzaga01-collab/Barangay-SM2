{{-- ══ MASTERLIST TAB ══ --}}
<div x-show="activeTab === 'masterlist'" x-transition>
    <div class="card">
        <div class="card-head">
            <div class="card-title"><i class="fas fa-users"></i> Resident Masterlist</div>
            <div style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
                <div class="card-badge" x-text="filteredResidents.length+' Residents'"></div>
                
                {{-- Archived Residents Button (Moved beside Export CSV) --}}
                <button type="button" @click="activeTab='archived'"
                   class="btn-grad btn-grad-sm"
                   style="background:linear-gradient(135deg,#d97706 0%,#b45309 100%); box-shadow:0 2px 6px rgba(217,119,6,.3); padding:6px 13px; font-weight:800; font-size:10px; border:none; cursor:pointer; display:inline-flex; align-items:center; gap:6px; color:#fff; border-radius:var(--r-btn);"
                   title="View Archived Residents">
                    <i class="fas fa-archive"></i> <span>Archived Residents</span>
                    <span style="background:rgba(255,255,255,0.25); padding:1px 6px; border-radius:99px; font-size:9px;">{{ $archivedResidentsCount ?? 0 }}</span>
                </button>

                <a :href="'/office/export?filter=' + encodeURIComponent(activeFilter) + '&search=' + encodeURIComponent(searchQuery)"
                   class="btn-grad btn-grad-sm"
                   style="background:linear-gradient(135deg,#059669 0%,#047857 100%); box-shadow:0 2px 8px rgba(5,150,105,.3); padding:6px 13px; font-weight:800; font-size:10px; text-decoration:none; display:inline-flex; align-items:center; gap:6px; color:#fff; border-radius:var(--r-btn);"
                   title="Export Resident Masterlist to CSV">
                    <i class="fas fa-file-csv"></i> <span>Export CSV</span>
                </a>
            </div>
        </div>
        <div style="overflow-x:auto;">
            <table class="res-table master-tbl">
                <thead>
                    <template x-if="activeFilter !== 'heads'">
                        <tr>
                            <th>Photo</th>
                            <th>Resident Details</th>
                            <th>Classification</th>
                            <th>Digital ID</th>
                            <th>Actions</th>
                        </tr>
                    </template>
                    <template x-if="activeFilter === 'heads'">
                        <tr>
                            <th>Photo</th>
                            <th>Head's Name</th>
                            <th>Household ID</th>
                            <th>Member Count</th>
                            <th style="text-align:center;"><i class="fas fa-chevron-down" style="font-size:10px;color:#94a3b8;" title="Click row to expand members"></i></th>
                        </tr>
                    </template>
                </thead>
                <template x-if="filteredResidents.length === 0">
                    <tbody>
                        <tr><td colspan="5"><div class="empty-st"><i class="fas fa-users"></i><p>No record found</p></div></td></tr>
                    </tbody>
                </template>
                <template x-for="r in filteredResidents" :key="r.id">
                    <tbody style="border-bottom:1px solid var(--border);">
                        <template x-if="activeFilter !== 'heads'">
                            <tr :id="'res-' + r.id"
                                :style="r.is_household_head ? 'background:#f8fafc; cursor:pointer;' : ''"
                                @click="if(r.is_household_head) viewFamily(r)"
                                class="res-row-hover">
                                <td style="text-align:center;">
                                     <img :src="r.photo||'https://ui-avatars.com/api/?name='+encodeURIComponent(r.name)+'&background=0E5393&color=fff&bold=true&rounded=true'"
                                         x-on:error="$el.src='https://ui-avatars.com/api/?name='+encodeURIComponent(r.name)+'&background=0E5393&color=fff&bold=true&rounded=true'"
                                         style="width:36px;height:36px;border-radius:9px;object-fit:cover;border:2px solid #fff;box-shadow:0 1px 4px rgba(0,0,0,.1);display:block;margin:0 auto;">
                                </td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:6px;">
                                        <div class="res-name" x-text="r.name"></div>
                                        <span x-show="r.is_household_head" style="font-size:8px;background:var(--brand);color:#fff;padding:1px 5px;border-radius:4px;font-weight:900;text-transform:uppercase;">Head</span>
                                    </div>
                                    <div class="res-code" x-text="r.code+' • '+(r.contact||'No contact')"></div>
                                    <div class="res-code" style="text-transform:lowercase;font-weight:700;color:var(--brand);margin-top:2px;" x-show="r.email"><i class="fas fa-envelope"></i> <span x-text="r.email"></span></div>
                                </td>
                                <td>
                                    <div style="display:flex;gap:4px;flex-wrap:wrap;justify-content:flex-start;">
                                        <span x-show="r.is_voter" class="pill pill-voter">Voter</span>
                                        <span x-show="r.is_non_voter" class="pill pill-voter" style="background:#fef3c7;color:#a16207;">Non-Voter</span>
                                        <span x-show="r.is_pwd" class="pill pill-pwd">PWD</span>
                                        <span x-show="r.is_bedridden" class="pill pill-pwd" style="background:#fee2e2;color:#dc2626;">Bed-ridden</span>
                                        <span x-show="r.is_senior" class="pill pill-senior">Senior</span>
                                        <span x-show="r.is_single_parent" class="pill pill-solo">Solo</span>
                                    </div>
                                </td>
                                <td style="text-align:center;">
                                    <template x-if="r.digital_id_generated">
                                        <button @click="selectDigitalIdResident(r); openDigitalId=true;"
                                                class="btn-outline" style="font-size:9px;padding:3px 8px;border-radius:99px;border:1.5px solid var(--brand);color:var(--brand);background:#fff;display:inline-flex;align-items:center;gap:4px;cursor:pointer;">
                                            <i class="fas fa-id-card"></i> View ID
                                        </button>
                                    </template>
                                </td>
                                <td>
                                    <div class="tbl-acts">
                                        <button @click="openProfile(r)" class="tbl-btn tbl-view" title="View"><i class="fas fa-eye"></i></button>
                                        <button @click="openAddPetModal=true; petTypeSelection=''; selectedUser=r; petPhotoPreview=null; vaccineProofPreview=null;" class="tbl-btn tbl-pet" title="Pet"><i class="fas fa-paw"></i></button>
                                        <button @click="openEdit(r.id)" class="tbl-btn tbl-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                        <button type="button"
                                                @click="archiveTarget={id:r.id,name:r.name}; archiveModal=true"
                                                class="tbl-btn" title="Archive"
                                                style="width:30px;height:30px;border-radius:7px;background:#fef3c7;color:#d97706;border:none;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;font-size:11px;">
                                            <i class="fas fa-archive"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template x-if="activeFilter === 'heads'">
                            <tr @click="viewFamily(r)"
                                style="cursor:pointer;transition:background .15s;"
                                onmouseover="this.style.background='#eff6ff'"
                                onmouseout="this.style.background=''">
                                <td style="text-align:center;">
                                    <img :src="r.photo||'https://ui-avatars.com/api/?name='+encodeURIComponent(r.name)+'&background=0E5393&color=fff&bold=true&rounded=true'"
                                         x-on:error="$el.src='https://ui-avatars.com/api/?name='+encodeURIComponent(r.name)+'&background=0E5393&color=fff&bold=true&rounded=true'"
                                         style="width:36px;height:36px;border-radius:9px;object-fit:cover;border:2px solid #fff;box-shadow:0 1px 4px rgba(0,0,0,.1);display:block;margin:0 auto;">
                                </td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:6px;">
                                        <div class="res-name" x-text="r.name"></div>
                                        <span style="font-size:8px;background:var(--brand);color:#fff;padding:1px 5px;border-radius:4px;font-weight:900;text-transform:uppercase;">Head</span>
                                    </div>
                                    <div class="res-code" x-text="r.address"></div>
                                </td>
                                <td class="res-code" x-text="r.household_id || r.code"></td>
                                <td style="text-align:center;">
                                    <div class="res-name" x-text="allResidents.filter(m => m.household_head_id === r.id).length + 1"></div>
                                    <div style="font-size:8px;color:var(--muted);font-weight:700;text-transform:uppercase;">Members</div>
                                </td>
                                <td style="text-align:center;">
                                    <i class="fas fa-chevron-right" style="font-size:11px;color:#94a3b8;"></i>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </template>
            </table>
        </div>
    </div>
</div>
