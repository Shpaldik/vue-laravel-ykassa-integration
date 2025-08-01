<script setup lang="ts">
import { computed, onMounted, onUnmounted, ref } from "vue";

const props = withDefaults(
  defineProps<{
    align?: "left" | "right";
    width?: "48";
    contentClasses?: string;
  }>(),
  {
    align: "right",
    width: "48",
    contentClasses: "py-1 bg-skin-card text-skin-base",
  }
);

const open = ref(false);

const closeOnEscape = (e: KeyboardEvent) => {
  if (open.value && e.key === "Escape") {
    open.value = false;
  }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));
onUnmounted(() => document.removeEventListener("keydown", closeOnEscape));

const widthClass = computed(() => {
  return {
    48: "w-48",
  }[props.width.toString()];
});

const alignmentClasses = computed(() => {
  if (props.align === "left") {
    return "ltr:origin-top-left rtl:origin-top-right start-0";
  } else if (props.align === "right") {
    return "ltr:origin-top-right rtl:origin-top-left end-0";
  } else {
    return "origin-top";
  }
});
</script>

<template>
  <div class="relative">
    <div @click="open = !open">
      <slot name="trigger" />
    </div>

    <div v-show="open" class="fixed inset-0 z-40" @click="open = false"></div>

    <Transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <div
        v-show="open"
        class="absolute z-50 mt-2 rounded-md shadow-lg transition-colors"
        :class="[widthClass, alignmentClasses]"
        style="display: none"
        @click="open = false"
      >
        <div
          class="rounded-md ring-1 ring-skin-border ring-opacity-5"
          :class="contentClasses"
        >
          <slot name="content" />
        </div>
      </div>
    </Transition>
  </div>
</template>
