<script setup>
import { onMounted, onUnmounted, ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { Inertia } from "@inertiajs/inertia";

let intervalId;
const last_numbers = ref([]);
const next_number = ref("");

onMounted(async () => {
    const { data } = await axios.get(route("lottery.info"));
    last_numbers.value = data.last_numbers;

    // Next Number Counting Down
    var countDownDate = new Date(data.next_number);

    intervalId = setInterval(function () {
        // Get today's date and time
        var now = new Date();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor(
            (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        );
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        next_number.value =
            days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

        // If the count down is over, reset the date
        if (distance < 0) {
            Inertia.reload();
        }
    }, 1000);
});

onUnmounted(() => clearInterval(intervalId));
</script>

<template>
    <div class="lottery__win">
        <div class="lottery__head">
            <h5>Weekly Lottery</h5>
            <Link :href="route('lottery.index')" class="button"
                >Peek your Lucky Numbers</Link
            >
        </div>
        <div class="lottery__numbers">
            <div class="row">
                <div
                    v-for="(ticket, index) in last_numbers"
                    :key="index"
                    class="col-lg-6 column__space"
                >
                    <div class="numbers__single">
                        <div class="numbers__head">
                            <p v-if="index == 0" class="tertiary">
                                This week's numbers
                            </p>
                            <p v-if="index == 1" class="tertiary">
                                last week's numbers
                            </p>

                            <p
                                v-if="index == 0"
                                class="count__wrapper tertiary"
                            >
                                Next Number In :
                                <span class="tertiary">{{ next_number }}</span>
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
