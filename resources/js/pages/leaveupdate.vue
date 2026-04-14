<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Option } from 'lucide-vue-next';
import { ref, onMounted, watch } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Leave Update',
        href: '/leaveupdate',
    },
];



const leaves = ref([
    {
        dateRequested: '03/20/2026',
        classification: 'With Pay',
        type: 'Sick Leave',
        datePrepared: '03/18/2026',
        status: 'Approved'
    },
    {
        dateRequested: '03/22/2026',
        classification: 'Without Pay',
        type: 'Vacation Leave',
        datePrepared: '03/19/2026',
        status: 'Pending'
    },
    {
        dateRequested: '03/25/2026',
        classification: 'With Pay',
        type: 'Emergency Leave',
        datePrepared: '03/20/2026',
        status: 'Denied'
    }
]);
</script>
<!-- not sure ang code na wala pangtable sa database. -->
<template>
<Head title="Leave Update" />

<AppLayout :breadcrumbs="breadcrumbs">

<div class="w-full max-w-6xl bg-white shadow rounded-lg p-6">

    <h2 class="text-xl font-bold mb-4 text-center" style="color:black;">
        LEAVE REQUEST UPDATE
    </h2>

    <div class="overflow-x-auto" style="color: blueviolet;">
        <table class="w-full border border-gray-200 text-sm text-left">

            <!-- TABLE HEADER -->
            <thead class="bg-gray-100 text-black-600">
                <tr>
                    <th class="p-3 border">#</th>
                    <th class="p-3 border">Date Requested</th>
                    <th class="p-3 border">Classification</th>
                    <th class="p-3 border">Type of Leave</th>
                    <th class="p-3 border">Date Prepared</th>
                    <th class="p-3 border">Status</th>
                    <th class="p-3 border text-center">Action</th>
                </tr>
            </thead>

            <!-- TABLE BODY -->
            <tbody style="color: black;">
                <tr v-for="(leave, index) in leaves" :key="index" class="hover:bg-gray-50">

                    <td class="p-3 border">{{ index + 1 }}</td>

                    <td class="p-3 border">
                        {{ leave.dateRequested }}
                    </td>

                    <td class="p-3 border">
                        {{ leave.classification }}
                    </td>

                    <td class="p-3 border">
                        {{ leave.type }}
                    </td>

                    <td class="p-3 border">
                        {{ leave.datePrepared }}
                    </td>

                    <!-- STATUS -->
                    <td class="p-3 border font-semibold">
                        <span
                            :class="{
                                'text-green-600': leave.status === 'Approved',
                                'text-red-600': leave.status === 'Denied',
                                'text-yellow-600': leave.status === 'Pending'
                            }"
                        >
                            {{ leave.status }}
                        </span>
                    </td>

                    <!-- ACTION -->
                    <td class="p-3 border text-center">
                        <button class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700">
                            View
                        </button>
                    </td>

                </tr>
            </tbody>

        </table>
    </div>
</div>
</AppLayout>
</template>