<script setup>
defineProps({
    investments: Object,
});
</script>

<template>
    <div class="investment__history">
        <h6>Investments History</h6>
        <div class="investment__table__wrapper">
            <table class="investment__table">
                <thead>
                    <tr>
                        <th>Created</th>
                        <th>Expired</th>
                        <th>Plan</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="investment in investments" :key="investment.id">
                        <td>{{ dateFormat(investment.created_at) }}</td>
                        <td>{{ dateFormat(investment.expired_at) }}</td>
                        <td>{{ investment.plan }}</td>
                        <td>
                            <h6>{{ currency(investment.amount) }}</h6>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
