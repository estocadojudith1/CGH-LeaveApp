<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Option } from 'lucide-vue-next';
import { ref, onMounted, watch } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Leave Request Form',
        href: '/leaveform',
    },
];
/* =========================
   DEPARTMENT SELECTION
========================= */
const department = ref('');
defineProps<{
    name?: string;
}>();

/* =========================
   AUTO DATE PREPARED
========================= */
const datePrepared = ref('');

function updateDate() {
    const now = new Date();
    const options: Intl.DateTimeFormatOptions = {
        month: '2-digit',
        day: '2-digit',
        year: 'numeric',
    };
    datePrepared.value = now.toLocaleDateString('en-US', options);
}

onMounted(() => {
    updateDate();
});

/* =========================
   DATE COMPUTATION
========================= */
const dateFrom = ref('');
const dateTo = ref('');
const totalDays = ref(0);

watch([dateFrom, dateTo], () => {
    if (dateFrom.value && dateTo.value) {
        const start = new Date(dateFrom.value);
        const end = new Date(dateTo.value);

        const diffTime = end.getTime() - start.getTime();
        const days = diffTime / (1000 * 60 * 60 * 24);

        totalDays.value = days > 0 ? days : 0;
    }
});
</script>

<template>
<Head title="Leave Request Form" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col items-center p-6">
            <div class="w-full max-w-4xl rounded-xl border border-sidebar-border/70 bg-white p-8 shadow">
                <!-- HEADER -->
            <div class="flex items-center gap-4 mb-6">
                <img src="/cgh_logo.png" class="w-16 h-16 object-contain" />
                <h2 class="text-lg font-bold" style="color: black;">CHACON GENERAL HOSPITAL</h2>
            </div>
            <h1 class="text-center text-xl font-bold mb-6" style="color: black;">
                LEAVE APPLICATION FORM
            </h1>

                <div class="space-y-5">
                    <div class="grid grid-cols-2 gap-4" style="color: black;">
                        <div>
                            <label class="text-sm">Employee Name :</label>
                            <input type="text" class="input" />
                        </div>
                        <div>
                            <label class="text-sm">Date Prepared :</label>
                            <input type="text" class="input bg-gray-100" :value="datePrepared" readonly />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4" style="color: black;">
                        <div>
                            <label class="text-sm">Designation :</label>
                            <input type="text" class="input" />
                        </div>
                        <div>
                            <label class="text-sm">Department / Office :</label>
                            <select v-model="department" class="input">
                                <option value="">Select Department</option>
                                <option value="ER">EMERGENCY ROOM</option>
                                <option value="HR">HR DEPARTMENT</option>
                                <Option value="Phar">PHARMACY DEPARTMENT</option>
                                <option value="Rad">RADIOLOGY DEPARTMENT</option>
                                <option value="Lab">LABORATORY DEPARTMENT</option>
                                <option value="busi">BUSINESS OFFICE</OPTION>
                                <Option value="nurse">NURSING DEPARTMENT</option>
                                <option value="IT">IT DEPARTMENT</option>
                                <option value="acc">ACCOUNTING OFFICE</option>
                                <option value="opta">OPTOMETRY CLINIC</option>
                                <option value="info">INFORMATION DESK</option>
                                <option value="house">HOUSEKEEPING</option>
                                <option value="main">MAINTENANCE</option>
                                <option value="cook">DIETARY DEPARTMENT</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4" style="color: black;">
                        <div>
                            <label class="text-sm">From :</label>
                            <input type="date" class="input" v-model="dateFrom" />
                        </div>
                        <div>
                            <label class="text-sm">To :</label>
                            <input type="date" class="input" v-model="dateTo" />
                        </div>
                        <div>
                            <label class="text-sm">No. of Day/s :</label>
                            <input type="number" class="input bg-gray-100" :value="totalDays" readonly />
                        </div>
                    </div>

                    <div style="color: black;">
                        <label class="text-sm font-medium">Type of Leave :</label>
                        <div class="flex gap-6 mt-2">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="accent-blue-600" />
                                Vacation Leave
                            </label>

                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="accent-blue-600" />
                                Sick Leave
                            </label>

                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="accent-blue-600" />
                                Personal Leave
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="accent-blue-600" />
                                Official Business Leave
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="accent-blue-600" />
                                Emergency Leave
                            </label>
                        </div>
                    </div>
                    <div style="color: black;">
                        <div class="flex gap-6 mt-2">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="accent-blue-600" />
                                Maternity Leave
                            </label>
                                <label class="flex items-center gap-2">
                                <input type="checkbox" class="accent-blue-600" />
                                Paternity Leave
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="accent-blue-600" />
                                Others:
                            </label>
                            <input type="text" class="input"/>
                            </div>
                        </div>

                    <div style="color: black;">
                        <label class="text-sm font-medium">Classification of Leave :</label>
                        <div class="flex gap-6 mt-2">
                            <label class="flex items-center gap-2">
                                <input type="radio" name="classification" class="accent-blue-600" />
                                Leave with Pay
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="classification" class="accent-blue-600" />
                                Leave without Pay
                            </label>
                        </div>
                    </div>

                    <div style="color: black;">
                        <label class="text-sm">Reason for Leave :</label>
                        <textarea class="input h-10"></textarea>
                    </div>

                    <div style="color: black;">
                        <label class="text-sm">Address while on Leave :</label>
                        <input type="text" class="input" />
                    </div>

                    <br><br><br>

                    <div class="flex justify-end mt-8" style="color: black;">
                        <div class="text-center">
                            <div class="border-b w-60"></div>
                            <p class="text-sm mt-1">Employee Signature</p>
                        </div>
                    </div>

                    <!-- SUBMIT -->
                    <div class="flex justify-end mt-6" style="color: black;">
                        <button  class="rounded bg-blue-600 px-6 py-2 text-white hover:bg-blue-700">
                            Submit
                        </button>
                        
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.input {
    @apply mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400;
}
</style>