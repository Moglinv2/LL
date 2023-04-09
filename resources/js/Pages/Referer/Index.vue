<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
    reward_points: Number,
    referers_count: Array,
});
</script>

<template>
    <AppLayout title="Referers">
        <div class="dashboard__head">
            <h5>Affiliate Program</h5>
        </div>
        <div class="affiliate__links">
            <div class="row">
                <div class="col-lg-8">
                    <div class="affiliate__link column__space">
                        <h5>Your Affiliate Link</h5>
                        <div class="copy">
                            <p>
                                {{
                                    route("register", {
                                        referer: $page.props.user.referer_code,
                                    })
                                }}
                            </p>
                            <a
                                @click="
                                    copy(
                                        route('register', {
                                            referer:
                                                $page.props.user.referer_code,
                                        })
                                    )
                                "
                                class="button"
                                >Copy link</a
                            >
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="rank">
                        <h6>Rewards Points</h6>
                        <h5>{{ reward_points }}</h5>
                        <img
                            src="assets/images/dashboard/hands.png"
                            alt="Ranks"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="level">
            <div class="row">
                <div
                    v-for="(referer_count, index) in referers_count"
                    :key="index"
                    class="col-md-6 col-lg-4"
                >
                    <div class="level__single column__space">
                        <a href="#" class="button">{{ index + 1 }} Level</a>
                        <p>
                            {{ referer_count["total"] }} /
                            {{ referer_count["active"] }}
                        </p>
                        <p class="tertiary">Partners / Active</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
