<template>
  <card :title="$t('dashboard')">
    <div class="d-flex align-items-center">
      <status-card text="Users" :value="modelCounts.users" />

      <status-card text="Resources" :value="modelCounts.resources" />

      <status-card
        text="Resource Filters"
        :value="modelCounts.resources_filters"
      />

      <status-card text="Risks" :value="modelCounts.risks" />
    </div>
  </card>
</template>

<script>
import axios from "axios";
import StatusCard from "~/components/StatusCard";
export default {
  data: () => ({
    modelCounts: []
  }),
  components: {
    StatusCard
  },
  middleware: "auth",

  metaInfo() {
    return { title: this.$t("home") };
  },

  mounted() {
    axios
      .get("api/models/count")
      .then(response => (this.modelCounts = response.data));
  }
};
</script>
