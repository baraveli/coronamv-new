<template>
  <div class="shadow-sm w-50 relative flex flex-column ml-2" style="margin-top:0px;">
    <div class="pa3">
      <h5 class="text-center" style="color:#3A3A56;">{{ text }}</h5>
      <h4
        class="mv0 mt-2 f2 text-center"
        style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 700;"
      >
        {{ Number(value).toLocaleString() }}
      </h4>
    </div>
  </div>
</template>

<script>
export default {
  name: "StausCard",
  props: {
    text: { type: String, default: null },
    value: { type: Number, default: null }
  }
};
</script>
