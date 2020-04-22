<template>
  <card :title="$t('risk')">
    <form @submit.prevent="AddRisk" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="message" />

      <!-- Name -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("div_name")
        }}</label>
        <div class="col-md-7">
          <input
            dir="rtl"
            v-model="form.name"
            :class="{ 'is-invalid': form.errors.has('name') }"
            class="form-control"
            type="text"
            name="name"
          />
          <has-error :form="form" field="name" />
        </div>
      </div>

      <!-- English name -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("en_name")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.en_name"
            :class="{ 'is-invalid': form.errors.has('en_name') }"
            class="form-control"
            type="text"
            name="en_name"
          />
          <has-error :form="form" field="en_name" />
        </div>
      </div>

      <!-- Alert -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("alert")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.alert"
            :class="{ 'is-invalid': form.errors.has('alert') }"
            class="form-control"
            type="text"
            name="alert"
          />
          <has-error :form="form" field="alert" />
        </div>
      </div>

      <!-- Level -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("level")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.level"
            :class="{ 'is-invalid': form.errors.has('level') }"
            class="form-control"
            type="text"
            name="level"
          />
          <has-error :form="form" field="level" />
        </div>
      </div>


       <!-- Class -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("class")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.class"
            :class="{ 'is-invalid': form.errors.has('class') }"
            class="form-control"
            type="text"
            name="class"
          />
          <has-error :form="form" field="class" />
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-7 offset-md-3 d-flex">
          <!-- Submit Button -->
          <v-button :loading="form.busy">
            {{ $t("create") }}
          </v-button>
        </div>
      </div>
    </form>

    <b-input-group class="mt-3 mb-3" size="sm">
      <b-form-input
        v-model="keyword"
        placeholder="Search"
        type="text"
        style="background-color: #F4F4F4;"
      >
      </b-form-input>

      <div class="col-3 mb-2">
        <b-form-select
          v-model="perPage"
          id="perPageSelect"
          size="sm"
          :options="pageOptions"
          style="background-color: #F4F4F4;"
        ></b-form-select>
      </div>
    </b-input-group>

    <b-table
      head-variant="dark"
      :fields="fields"
      :items="items"
      :per-page="perPage"
      :current-page="currentPage"
      :keyword="keyword"
    >
      <template v-slot:cell(actions)="row">
        <b-button
          @click="
            ModalStateToggle();
            SetModalData(row.item);
          "
          variant="primary"
          size="sm"
          class="mr-1"
        >
          Edit
        </b-button>

        <b-button
          variant="danger"
          size="sm"
          @click="DestroyRisk(row.item.id)"
          class="mr-1"
        >
          Delete
        </b-button>

        <b-modal
          v-model="modalShow"
          title="Edit a Risk"
          @ok="UpdateRisk(modalData)"
        >
          <h5 style="color: red;">
            Risks ID: <span v-text="modalData.id"></span>
          </h5>
          <!-- Name -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("name")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.name"
                class="form-control"
                type="text"
                name="name"
              />
            </div>
          </div>

          <!-- E Name -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("en_name")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.en_name"
                class="form-control"
                type="text"
                name="en_name"
              />
            </div>
          </div>

          <!-- Alert -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("alert")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.alert"
                class="form-control"
                type="text"
                name="alert"
              />
            </div>
          </div>

          <!-- Level -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("level")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.level"
                class="form-control"
                type="text"
                name="level"
              />
            </div>
          </div>

            <!-- Class -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("class")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.class"
                class="form-control"
                type="text"
                name="class"
              />
            </div>
          </div>

          <p class="font-weight-bold">
            Created At:
            <time class="text-muted">{{
              modalData.created_at | formatDate
            }}</time>
          </p>
        </b-modal>
      </template>
    </b-table>

    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="my-table"
      pills
      limit="6"
    ></b-pagination>

    <div>
      <p class="o-70">{{ entries }}</p>
    </div>

    <div></div>
  </card>
</template>

<script>
import Form from "vform";
import axios from "axios";
import moment from "moment";

export default {
  data: () => ({
    modalShow: false,
    modalData: [],

    message: "",
    form: new Form({
      name: "",
      en_name: "",
      alert: "",
      level: "",
      class: ""
    }),
    perPage: 10,
    currentPage: 1,
    pageOptions: [5, 10, 15, 20],
    keyword: "",
    dataArray: [],
    fields: [
      {
        key: "id",
        label: "ID",
        sortable: true
      },
      {
        key: "name",
        label: "Name",
        sortable: true
      },
      {
        key: "en_name",
        label: "E Name",
        sortable: true
      },
      {
        key: "alert",
        label: "Alert",
        sortable: false
      },
      {
        key: "level",
        label: " Level",
        sortable: true
      },
       {
        key: "class",
        label: " Class",
        sortable: false
      },
      { key: "actions", label: "Actions" }
    ]
  }),

  computed: {
    // calculating record states
    entries: function() {
      return `Showing ${this.perPage * this.currentPage -
        this.perPage +
        1} to ${this.perPage * this.currentPage} of ${this.rows} entries`;
    },

    items: function() {
      return this.keyword
        ? this.dataArray.filter(item =>
            item.name
              .toLowerCase()
              .trim()
              .includes(this.keyword.toLowerCase())
          )
        : this.dataArray;
    },
    rows: function() {
      return this.items.length;
    }
  },
  mounted() {
    axios
      .get("/api/risks")
      .then(response => (this.dataArray = response.data.data));
  },

  metaInfo() {
    return { title: this.$t("stats") };
  },

  methods: {
    ModalStateToggle() {
      this.modalShow = !this.modalShow;
    },

    SetModalData(item) {
      this.modalData = item;
    },
    async AddRisk() {
      // Add Test
      let response = await this.form.post("/api/risks");

      this.dataArray.push(response.data.data);

      //Set flash message
      this.message = `${
        response.data.data.id
      } Risk has been added to the database!`;

      //Reset the form
      this.form.reset();
    },

    async UpdateRisk(risk) {
      this.form.fill(risk);

      let response = await this.form.put("/api/risks/" + risk.id);

      //Set flash message
      this.message = `Risk ${risk.id} has been updated`;

      //Reset the form
      this.form.reset();
    },

    async DestroyRisk(id) {
      let response = this.form.delete("/api/risks/" + id);

      this.dataArray = this.dataArray.filter(function(response) {
        return response.id !== id;
      });
      this.message = `Risk with id of ${id} has been deleted`;
    }
  },

  filters: {
    formatDate(value) {
      if (value) {
        return moment(String(value)).format("MM/DD/YYYY hh:mm");
      }
    }
  }
};
</script>
