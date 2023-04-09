<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="History">
<div class="dashboard__head">
    <h5>Wallet</h5>
</div>
<div class="transaction__history">
    <div class="history__head">
        <h6>Transactions History</h6>
        <div class="history__input__wrapper">
            <input type="text" name="search__history" id="transactionHistoryFilter" />
            <i class="fas fa-search"></i>
        </div>
    </div>
    <div class="history__table__wrapper">
        <table>
            <thead>
                <tr>
                    <th>
                        Date
                    </th>
                    <th>
                        Payment Method
                    </th>
                    <th>
                        Amount
                    </th>
                    <th>
                        Wallet ID
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2022.01.02 11:47:57 am</td>
                    <td><img src="assets/images/transaction/btc.png" alt="Bitcoin" />
                        Bitcoin</td>
                    <td>-$300.00</td>
                    <td>b4e70bcd-302e-44ef-8b11-d0</td>
                </tr>
                <tr>
                    <td>2022.01.02 11:47:57 am</td>
                    <td><img src="assets/images/transaction/btc.png" alt="Bitcoin" />
                        Bitcoin</td>
                    <td>-$300.00</td>
                    <td>b4e70bcd-302e-44ef-8b11-d0</td>
                </tr>
                <tr>
                    <td>2022.01.02 11:47:57 am</td>
                    <td><img src="assets/images/transaction/btc.png" alt="Bitcoin" />
                        Bitcoin</td>
                    <td>-$300.00</td>
                    <td>b4e70bcd-302e-44ef-8b11-d0</td>
                </tr>
                <tr>
                    <td>2022.01.02 11:47:57 am</td>
                    <td><img src="assets/images/transaction/btc.png" alt="Bitcoin" />
                        Bitcoin</td>
                    <td>-$300.00</td>
                    <td>b4e70bcd-302e-44ef-8b11-d0</td>
                </tr>
                <tr>
                    <td>2022.01.02 11:47:57 am</td>
                    <td><img src="assets/images/transaction/btc.png" alt="Bitcoin" />
                        Bitcoin</td>
                    <td>-$300.00</td>
                    <td>b4e70bcd-302e-44ef-8b11-d0</td>
                </tr>
                <tr>
                    <td>2022.01.02 11:47:57 am</td>
                    <td><img src="assets/images/transaction/btc.png" alt="Bitcoin" />
                        Bitcoin</td>
                    <td>-$300.00</td>
                    <td>b4e70bcd-302e-44ef-8b11-d0</td>
                </tr>
                <tr>
                    <td>2022.01.02 11:47:57 am</td>
                    <td><img src="assets/images/transaction/btc.png" alt="Bitcoin" />
                        Bitcoin</td>
                    <td>-$300.00</td>
                    <td>b4e70bcd-302e-44ef-8b11-d0</td>
                </tr>
                <tr>
                    <td>2022.01.02 11:47:57 am</td>
                    <td><img src="assets/images/transaction/btc.png" alt="Bitcoin" />
                        Bitcoin</td>
                    <td>-$300.00</td>
                    <td>b4e70bcd-302e-44ef-8b11-dt0</td>
                </tr>
            </tbody>
        </table>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" href="javascript:void(0)">
                    <img src="assets/images/icons/left-arrow.png" alt="Previous" />
                </a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)">01</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)">02</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)">03</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)">04</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)">
                    <img src="assets/images/icons/right-arrow.png" alt="Next" />
                </a></li>
        </ul>
    </nav>
</div>
    </AppLayout>
</template>
