<template>
    <section>
        <div class="container pt-3">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="card-body p-3">
                            <h2 class="fw-bold text-uppercase text-center">
                                {{ title }}
                            </h2>
                            <slot />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
defineProps({
    title: {
        type: String,
        required: true
    }
})

</script>