<script setup>
import WeeklyLottery from "../../../Partials/WeeklyLottery.vue";

const props = defineProps({
    last_numbers: Array,
    active_tickets: Array,
});

const total_invested = props.active_tickets.reduce(
    (curr, val) => curr + val.price,
    0
);
</script>

<template>
    <div class="overview__inner">
        <div class="row">
            <div class="col-lg-6">
                <div class="overview__inner__single column__space">
                    <div class="overview__inner__item">
                        <img
                            src="assets/images/dashboard/invested.png"
                            alt="Invested"
                        />
                        <div class="overview__inner__content">
                            <h5>{{ currency(total_invested) }}</h5>
                            <p class="tertiary">Invested</p>
                        </div>
                    </div>
                    <hr />
                    <p class="tertiary alt">
                        Your active investment on Monday 27th December 6pm
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="overview__inner__single">
                    <div class="overview__inner__item">
                        <img
                            src="/assets/images/dashboard/ticket.png"
                            alt="Tickets"
                        />
                        <div class="overview__inner__content">
                            <h5>{{ pad(active_tickets.length) }}</h5>
                            <p class="tertiary">Tickets</p>
                        </div>
                    </div>
                    <hr />
                    <p class="tertiary alt">
                        Received for this week (25$ / per Ticket)
                    </p>
                </div>
            </div>
        </div>
    </div>

    <WeeklyLottery />

    <!-- Active Tickets -->
    <div class="lottery__win">
        <div class="lottery__head">
            <h5>
                <img src="assets/images/icons/login.png" alt="Calendar" />
                Active Tickets
            </h5>
        </div>
        <div class="lottery__numbers">
            <div class="row">
                <div
                    class="col-lg-6 column__space"
                    style="margin-bottom: 20px"
                    v-for="ticket in active_tickets"
                    :key="ticket.id"
                >
                    <div class="numbers__single">
                        <div class="numbers__head">
                            <p class="tertiary">This week's numbers</p>
                            <p class="count__wrapper tertiary">
                                Next Number In :
                                <span class="hours tertiary"></span>
                            </p>
                        </div>
                        <div class="numbers">
                            <div
                                v-for="(number, index) in ticket.numbers"
                                :key="index"
                                class="numbers__single__item"
                            >
                                <p>{{ pad(number) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
