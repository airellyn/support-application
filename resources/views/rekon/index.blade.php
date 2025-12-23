@extends('layout.main')

@section('content')
<div 
    x-data="rekonPage()" 
    x-init="initData()" 
    class="w-full max-w-full px-2 md:px-4 lg:px-6 py-4">

    {{-- Title --}}
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Rekonsiliasi Data</h1>
    </div>

    {{-- Date Picker --}}
    <div class="bg-white p-6 rounded-xl shadow mb-8">
        <form @submit.prevent="startRecon">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="text-sm font-semibold text-gray-700">From Date</label>
                    <input type="date" x-model="from_date"
                        class="w-full p-2 mt-2 border rounded-lg focus:ring focus:ring-blue-300">
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-700">To Date</label>
                    <input type="date" x-model="to_date"
                        class="w-full p-2 mt-2 border rounded-lg focus:ring focus:ring-blue-300">
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        :disabled="isLoading"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold p-3 rounded-lg shadow disabled:bg-blue-400">
                        <span x-show="!isLoading">Start Reconciliation</span>
                        <span x-show="isLoading" class="flex items-center justify-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Processing...
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Debug Section --}}
    <div class="bg-yellow-100 p-4 rounded mb-4" x-show="rawResults.length > 0">
        <h3 class="font-bold">Debug Info:</h3>
        <p>Total Results: <span x-text="rawResults.length"></span></p>
        <p>Filtered Results: <span x-text="filteredResults.length"></span></p>
        <p>Bag Summary: <span x-text="JSON.stringify(bagSummary)"></span></p>
        <p>Ant Summary: <span x-text="JSON.stringify(antSummary)"></span></p>
    </div>

    {{-- Summary Cards (Tipe: Pesawat, Hotel, Kereta) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">
        <template x-for="t in types" :key="t">
        <div class="bg-white rounded-xl shadow p-4 overflow-x-auto max-w-full">
                <h2 class="text-xl font-bold text-gray-800 mb-4" x-text="t"></h2>

                {{-- Bag Daily Section --}}
                <div class="mb-4 pb-3 border-b">
                    <h3 class="text-sm font-semibold text-green-600 mb-2">Bag Daily</h3>
                    <div class="text-xs text-gray-600 space-y-1">
                        <div class="flex justify-between">
                            <span>Total Transaksi</span>
                            <span class="font-semibold" x-text="formatNumber(bagSummary[t]?.total_transaksi || 0)"></span>
                        </div>
                        <div class="flex justify-between">
                            <span>Total Biaya</span>
                            <span x-text="formatCurrency(bagSummary[t]?.total_flare || 0)"></span>
                        </div>
                        <div class="flex justify-between">
                            <span>Service Fee</span>
                            <span x-text="formatCurrency(bagSummary[t]?.service_fee || 0)"></span>
                        </div>
                    </div>
                </div>

                {{-- Antavaya Section --}}
                <div class="mb-2">
                    <h3 class="text-sm font-semibold text-orange-600 mb-2">Antavaya</h3>
                    <div class="text-xs text-gray-600 space-y-1">
                        <div class="flex justify-between">
                            <span>Total Transaksi</span>
                            <span class="font-semibold" x-text="formatNumber(antSummary[t]?.total_transaksi || 0)"></span>
                        </div>
                        <div class="flex justify-between">
                            <span>Total Biaya</span>
                            <span x-text="formatCurrency(antSummary[t]?.total_flare || 0)"></span>
                        </div>
                        <div class="flex justify-between">
                            <span>Service Fee</span>
                            <span x-text="formatCurrency(antSummary[t]?.service_fee || 0)"></span>
                        </div>
                    </div>
                </div>

                {{-- Summary Perbandingan --}}
                <div class="mt-3 pt-3 border-t">
                    <h3 class="text-sm font-semibold text-blue-600 mb-2">Summary</h3>
                    <div class="text-xs space-y-1">
                        <div class="flex justify-between">
                            <span>Selisih Transaksi</span>
                            <span :class="getTransactionDiff(t) < 0 ? 'text-red-600' : 'text-green-600'" 
                                  x-text="getTransactionDiff(t)"></span>
                        </div>
                        <div class="flex justify-between">
                            <span>Selisih Biaya</span>
                            <span :class="getCostDiff(t) < 0 ? 'text-red-600' : 'text-green-600'" 
                                  x-text="formatCurrency(Math.abs(getCostDiff(t)))"></span>
                        </div>
                        <div class="flex justify-between font-semibold">
                            <span>Status</span>
                            <span :class="getStatus(t) === 'MATCH' ? 'text-green-600' : 'text-red-600'" 
                                  x-text="getStatus(t)"></span>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    {{-- Summary BAg --}}
    <div class="bg-white shadow p-6 rounded-xl border-l-4 border-green-500 mb-10">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Summary BAg Daily</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Per Tipe</h3>
                <div class="text-sm text-gray-700 space-y-2">
                    <template x-for="t in types">
                        <div class="border-b pb-2">
                            <div class="font-medium" x-text="t"></div>
                            <div class="flex justify-between text-xs">
                                <span>Transaksi:</span>
                                <span x-text="formatNumber(bagSummary[t]?.total_transaksi || 0)"></span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span>Total Biaya:</span>
                                <span x-text="formatCurrency(bagSummary[t]?.total_flare || 0)"></span>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Overall</h3>
                <div class="text-sm text-gray-700 space-y-2">
                    <div class="flex justify-between">
                        <span>Total Flare/Biaya</span>
                        <span x-text="formatCurrency(bagOverall.total_flare || 0)"></span>
                    </div>
                    <div class="flex justify-between">
                        <span>Total + Service Fee</span>
                        <span x-text="formatCurrency(bagOverall.total_plus_fee || 0)"></span>
                    </div>
                    <div class="flex justify-between">
                        <span>Margin 10.60%</span>
                        <span x-text="formatCurrency(bagOverall.margin || 0)"></span>
                    </div>
                    <div class="flex justify-between font-semibold border-t pt-2">
                        <span>Total Tagihan</span>
                        <span x-text="formatCurrency(bagOverall.grand_total || 0)"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Summary Antavaya --}}
    <div class="bg-white shadow p-6 rounded-xl border-l-4 border-orange-500 mb-10">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Summary Antavaya</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Per Tipe</h3>
                <div class="text-sm text-gray-700 space-y-2">
                    <template x-for="t in types">
                        <div class="border-b pb-2">
                            <div class="font-medium" x-text="t"></div>
                            <div class="flex justify-between text-xs">
                                <span>Transaksi:</span>
                                <span x-text="formatNumber(antSummary[t]?.total_transaksi || 0)"></span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span>Total Biaya:</span>
                                <span x-text="formatCurrency(antSummary[t]?.total_flare || 0)"></span>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Overall</h3>
                <div class="text-sm text-gray-700 space-y-2">
                    <div class="flex justify-between">
                        <span>VAT</span>
                        <span x-text="formatCurrency(antOverall.vat || 0)"></span>
                    </div>
                    <div class="flex justify-between">
                        <span>Total tanpa VAT</span>
                        <span x-text="formatCurrency(antOverall.total_without_vat || 0)"></span>
                    </div>
                    <div class="flex justify-between font-semibold border-t pt-2">
                        <span>Total + VAT</span>
                        <span x-text="formatCurrency(antOverall.total_with_vat || 0)"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    {{-- FILTERS --}}
    <div class="bg-white p-5 rounded-xl shadow flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
        {{-- Search --}}
        <div class="w-full md:w-1/2">
            <input type="text" x-model="search"
                placeholder="Cari kode booking atau remark..."
                class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">
        </div>

        {{-- Filter Match --}}
        <div>
            <select x-model="filterStatus"
                class="p-2 border rounded-lg bg-gray-50 focus:ring focus:ring-blue-300">
                <option value="ALL">Semua</option>
                <option value="MATCH">MATCH</option>
                <option value="NOT MATCH">NOT MATCH</option>
            </select>
        </div>
        <button 
            @click="downloadExcel"
            :disabled="!canDownload"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg shadow disabled:bg-green-400">
            Download Excel
        </button>
    </div>
    

    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow p-6 overflow-x-auto">

    <template x-if="paginated.length === 0">
        <p class="text-gray-500 text-center py-6" x-text="rawResults.length === 0 ? 'Belum Mulai Rekonsiliasi' : 'Tidak ada data yang sesuai dengan filter'"></p>
    </template>

    <template x-if="paginated.length > 0">
        <table class="w-full border-collapse text-left">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="p-3">Kode Booking</th>
                    <th class="p-3">Remark</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Return Date</th>
                    <th class="p-3">Traveler Name</th>
                    <th class="p-3">Description</th>
                    <th class="p-3">Airline Name</th>
                    <th class="p-3">Tipe</th>
                    <th class="p-3 text-center">Status</th>
                </tr>
            </thead>

            <tbody>
                <template x-for="row in paginated">
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3" x-text="row.kode_booking"></td>
                        <td class="p-3" x-text="row.remark_1"></td>
                        <td class="p-3" x-text="row.date"></td>
                        <td class="p-3" x-text="row.return_date"></td>
                        <td class="p-3" x-text="row.traveler_name"></td>
                        <td class="p-3" x-text="row.description"></td>
                        <td class="p-3" x-text="row.airline_name"></td>
                        <td class="p-3" x-text="row.tipe"></td>
                        <td class="p-3 text-center">
                            <span 
                                class="font-bold"
                                :class="row.status === 'MATCH' ? 'text-green-600' : 'text-red-600'"
                                x-text="row.status">
                            </span>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </template>

        {{-- CUSTOM PAGINATION --}}
        <div class="flex justify-center mt-6 space-x-2" x-show="totalPages > 1">

            <button 
                @click="prevPage"
                class="px-3 py-1 rounded-lg border hover:bg-gray-100"
                :disabled="page === 1">
                Prev
            </button>

            <template x-for="i in totalPages">
                <button 
                    @click="page = i"
                    class="px-3 py-1 rounded-lg border"
                    :class="page === i ? 'bg-blue-600 text-white' : 'hover:bg-gray-100'"
                    x-text="i">
                </button>
            </template>

            <button 
                @click="nextPage"
                class="px-3 py-1 rounded-lg border hover:bg-gray-100"
                :disabled="page === totalPages">
                Next
            </button>

        </div>
    </div>

</div>

{{-- Alpine Script --}}
<script>
function rekonPage() {
    return {
        from_date: '',
        to_date: '',
        types: ["PESAWAT", "HOTEL", "KERETA"],
        rawResults: [],
        filteredResults: [],
        search: '',
        filterStatus: 'ALL',
        page: 1,
        perPage: 10,
        isLoading: false,
        canDownload: false,

        bagSummary: {},
        antSummary: {},
        bagOverall: {},
        antOverall: {},

        initData() {
            this.$watch('search', () => {
                this.page = 1;
                this.applyFilters();
            });
            
            this.$watch('filterStatus', () => {
                this.page = 1;
                this.applyFilters();
            });
        },

        startRecon() {
            this.isLoading = true;
            this.canDownload = false;
            
            fetch("{{ route('rekon.process') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    from_date: this.from_date,
                    to_date: this.to_date
                })
            })
            .then(async (res) => {
                const contentType = res.headers.get('content-type');
                
                if (!contentType || !contentType.includes('application/json')) {
                    const text = await res.text();
                    throw new Error(`Expected JSON but got: ${text.substring(0, 100)}...`);
                }
                
                return res.json();
            })
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }

                if (data.ba_created) {
                    alert('Berita Acara Rekonsiliasi berhasil dibuat!');
                }
                
                this.rawResults = data.results || [];
                this.bagSummary = data.bagSummary || {};
                this.antSummary = data.antSummary || {};
                this.bagOverall = data.bagOverall || {};
                this.antOverall = data.antOverall || {};
                
                this.page = 1;
                this.applyFilters();
                this.canDownload = this.rawResults.length > 0;
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error: ' + error.message);
            })
            .finally(() => {
                this.isLoading = false;
            });
        },

        downloadExcel() {
            if (!this.canDownload) {
                alert('Tidak ada data untuk di-download');
                return;
            }

            // Gunakan window.location untuk download - lebih reliable
            const downloadUrl = "{{ route('rekon.download') }}";
            window.location.href = downloadUrl;
        },

        applyFilters() {
            let temp = [...this.rawResults];

            // Search filter
            if (this.search.trim() !== "") {
                const searchTerm = this.search.toLowerCase().trim();
                temp = temp.filter(r =>
                    (r.kode_booking?.toLowerCase().includes(searchTerm) ||
                     r.remark_1?.toLowerCase().includes(searchTerm) ||
                     r.traveler_name?.toLowerCase().includes(searchTerm) ||
                     r.description?.toLowerCase().includes(searchTerm))
                );
            }

            // Status filter
            if (this.filterStatus !== "ALL") {
                temp = temp.filter(r => r.status === this.filterStatus);
            }

            this.filteredResults = temp;
        },

        get totalPages() {
            return Math.ceil(this.filteredResults.length / this.perPage);
        },

        get paginated() {
            const start = (this.page - 1) * this.perPage;
            return this.filteredResults.slice(start, start + this.perPage);
        },

        nextPage() {
            if (this.page < this.totalPages) this.page++;
        },

        prevPage() {
            if (this.page > 1) this.page--;
        },

        getTransactionDiff(type) {
            const bagTrans = this.bagSummary[type]?.total_transaksi || 0;
            const antTrans = this.antSummary[type]?.total_transaksi || 0;
            return bagTrans - antTrans;
        },

        getCostDiff(type) {
            const bagCost = this.bagSummary[type]?.total_flare || 0;
            const antCost = this.antSummary[type]?.total_flare || 0;
            return bagCost - antCost;
        },

        getStatus(type) {
            const transDiff = this.getTransactionDiff(type);
            const costDiff = this.getCostDiff(type);
            
            const isCostMatch = Math.abs(costDiff) < 1000;
            const isTransMatch = transDiff === 0;
            
            return isCostMatch && isTransMatch ? 'MATCH' : 'NOT MATCH';
        },

        formatCurrency(num) {
            if (!num && num !== 0) return 'Rp 0';
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(num);
        },

        formatNumber(num) {
            if (!num && num !== 0) return '0';
            return new Intl.NumberFormat('id-ID').format(num);
        }
    }
}
</script>
@endsection