<template>
  <b-button variant="success" size="sm" @click="ExportCsv()" class="mr-1">
    Export to csv
  </b-button>
</template>

<script>
import axios from "axios";

export default {
  name: "ExportCsv",
  props: {
    ApiEndpoint: { type: String, default: null },
    FileName: {type: String, default: "file"}
  },

  methods: {
    ExportCsv() {
      axios({
        url: this.ApiEndpoint,
        method: "GET",
        responseType: "blob"
      }).then(response => {
        var fileURL = window.URL.createObjectURL(new Blob([response.data]));
        var fileLink = document.createElement("a");
        fileLink.href = fileURL;
        fileLink.setAttribute("download", `${this.FileName}.csv`);
        document.body.appendChild(fileLink);
        fileLink.click();
      });
    }
  }
};
</script>
