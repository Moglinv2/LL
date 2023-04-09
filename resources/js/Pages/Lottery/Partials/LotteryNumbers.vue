<script setup>
import { ref } from "vue";
import Swal from "sweetalert2";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    ticket_price: Number,
});

const numbers = Array.from(Array(60).keys()).map((e) => e + 1);
const numberSelected = ref([0, 0, 0, 0, 0, 0, 0]);

const isSelectedNumber = (number) => numberSelected.value.includes(number);
const isDisabledNumber = (number) =>
    !isSelectedNumber(number) && !numberSelected.value.includes(0);
const resetNumberSelected = () =>
    (numberSelected.value = [0, 0, 0, 0, 0, 0, 0]);

const selectRandomNumbers = () => {
    resetNumberSelected();
    while (numberSelected.value.includes(0)) {
        let number = numbers[Math.floor(Math.random() * numbers.length)];
        selectNumber(number);
    }
};

const selectNumber = (number) => {
    if (
        numberSelected.value.includes(0) &&
        !numberSelected.value.includes(number)
    ) {
        numberSelected.value[numberSelected.value.indexOf(0)] = number;
        numberSelected.value = numberSelected.value.sort((a, b) => a - b);
    }
};

const saveTicket = () => {
    Swal.fire({
        title: "Are you sure?",
        text: `This ticket has a value of  $${props.ticket_price}`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirm",
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.post(
                route("lottery.store"),
                {
                    numbers: numberSelected.value,
                },
                {
                    onSuccess() {
                        resetNumberSelected();
                    },
                }
            );
        }
    });
};
</script>

<template>
    <div class="row">
        <div class="col-xl-5">
            <div class="lottery__numbers__left">
                <div class="lottery__head">
                    <h5>
                        <img
                            src="assets/images/icons/login.png"
                            alt="Calendar"
                        />
                        Pick your lucky numbers
                    </h5>
                </div>

                <div class="lottery__reset">
                    <div class="reset__head">
                        <h6>
                            <img
                                src="assets/images/icons/login.png"
                                alt="Calendar"
                            />Your Lucky Numbers
                        </h6>
                        <a
                            href="javascript:void(0)"
                            @click="resetNumberSelected()"
                            class="reset"
                            ><i class="fas fa-redo"></i> Reset</a
                        >
                    </div>
                    <div class="numbers">
                        <div
                            v-for="(number, index) in numberSelected"
                            :key="index"
                            class="numbers__single__item"
                        >
                            <p class="ticket__numbers">{{ pad(number) }}</p>
                        </div>
                    </div>
                </div>

                <p>
                    Your lucky numbers are your default numbers for our lottery.
                </p>
                <p>
                    You can specify as many custom tickets as you want and all
                    the remaining tickets will be played with your default lucky
                    numbers.
                </p>
                <p>
                    If you only specify lucky numbers then all your tickets are
                    played with those numbers.
                </p>
                <p>
                    In case you did not set any numbers at the time the tickets
                    are locked in, you are still participating but your numbers
                    will be randomly chosen.
                </p>
            </div>
        </div>

        <div class="col-xl-7">
            <div class="lottery__numbers__right">
                <div class="custom__ticket">
                    <div class="custom__ticket__head">
                        <h6>
                            <img
                                src="assets/images/icons/login.png"
                                alt="Calendar"
                            />
                            Pick numbers for custom ticket
                        </h6>
                        <div class="btn__group">
                            <a
                                href="javascript:void(0)"
                                @click="selectRandomNumbers()"
                                class="group__active magic__filter"
                            >
                                <img
                                    src="assets/images/icons/magic.png"
                                    alt="Random Picker"
                                />
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="delete"
                                @click="resetNumberSelected()"
                            >
                                <img
                                    src="assets/images/icons/delete.png"
                                    alt="Reset"
                                />
                            </a>
                        </div>
                    </div>
                    <div class="custom__ticket__body">
                        <div
                            @click="selectNumber(number)"
                            v-for="(number, index) in numbers"
                            :key="index"
                            :class="{
                                custom__number__active:
                                    isSelectedNumber(number),
                                custom__number__deactive:
                                    isDisabledNumber(number),
                            }"
                            class="custom__number"
                        >
                            <p>{{ pad(number) }}</p>
                        </div>

                        <div class="preview__number">
                            <div class="numbers">
                                <div
                                    v-for="(number, index) in numberSelected"
                                    :key="index"
                                    class="numbers__single__item"
                                >
                                    <p class="ticket__numbers">
                                        {{ pad(number) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="save__ticket__wrapper">
                            <a
                                href="javascript:void(0)"
                                @click="saveTicket()"
                                class="save__ticket"
                            >
                                Save Ticket
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="last__wor">
        <h5>
            <img src="assets/images/icons/login.png" alt="Calendar" /> Your
            Custom Tickets
        </h5>
        <p>
            Based on your current investment, you will receive
            <span>12 tickets</span> therefore <span>0 out of 0</span> custom
            tickets will be used in the next lottery.
        </p>
        <p>No custom tickets yet</p>
    </div>
</template>
