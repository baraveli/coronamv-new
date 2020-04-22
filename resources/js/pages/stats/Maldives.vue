<template>
  <card :title="$t('maldives')">
    <form @submit.prevent="AddMaldivesData" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="message" />

      <!-- Dhivehi name -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("div_name")
        }}</label>
        <div class="col-md-7">
          <input
            dir="rtl"
            v-model="form.div_name"
            :class="{ 'is-invalid': form.errors.has('div_name') }"
            class="form-control"
            type="text"
            name="div_name"
          />
          <has-error :form="form" field="div_name" />
        </div>
      </div>

      <!-- Name -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("name")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.name"
            :class="{ 'is-invalid': form.errors.has('name') }"
            class="form-control"
            type="text"
            name="name"
          />
          <has-error :form="form" field="name" />
        </div>
      </div>

      <!-- Administratice atoll -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("administrative_atoll")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.administrative_atoll"
            :class="{ 'is-invalid': form.errors.has('administrative_atoll') }"
            class="form-control"
            type="text"
            name="administrative_atoll"
          />
          <has-error :form="form" field="administrative_atoll" />
        </div>
      </div>

      <!-- Confirmed -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("confirmed")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.confirmed"
            :class="{ 'is-invalid': form.errors.has('confirmed') }"
            class="form-control"
            type="text"
            name="confirmed"
          />
          <has-error :form="form" field="confirmed" />
        </div>
      </div>

      <!-- Recovered -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("recovered")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.recovered"
            :class="{ 'is-invalid': form.errors.has('recovered') }"
            class="form-control"
            type="text"
            name="recovered"
          />
          <has-error :form="form" field="recovered" />
        </div>
      </div>

      <!-- Deaths -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("deaths")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.deaths"
            :class="{ 'is-invalid': form.errors.has('deaths') }"
            class="form-control"
            type="text"
            name="deaths"
          />
          <has-error :form="form" field="deaths" />
        </div>
      </div>

      <!-- Active -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("active")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.active"
            :class="{ 'is-invalid': form.errors.has('active') }"
            class="form-control"
            type="text"
            name="active"
          />
          <has-error :form="form" field="active" />
        </div>
      </div>

      <!-- Lat -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("lat")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.lat"
            :class="{ 'is-invalid': form.errors.has('lat') }"
            class="form-control"
            type="text"
            name="lat"
          />
          <has-error :form="form" field="lat" />
        </div>
      </div>

      <!-- Long -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("long")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.long"
            :class="{ 'is-invalid': form.errors.has('long') }"
            class="form-control"
            type="text"
            name="long"
          />
          <has-error :form="form" field="long" />
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
          @click="DestroyMaldivesData(row.item.id)"
          class="mr-1"
        >
          Delete
        </b-button>

        <b-modal
          v-model="modalShow"
          title="Edit a MaldivesData"
          @ok="UpdateMaldivesData(modalData)"
        >
          <h5 style="color: red;">
            MaldivesData ID: <span v-text="modalData.id"></span>
          </h5>
          <!-- Dhivehi Name -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("div_name")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.div_name"
                class="form-control"
                type="text"
                name="div_name"
              />
            </div>
          </div>

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

          <!-- Administartive atoll -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("administrative_atoll")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.administrative_atoll"
                class="form-control"
                type="text"
                name="administrative_atoll"
              />
            </div>
          </div>

          <!-- Confirmed -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("confirmed")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.confirmed"
                class="form-control"
                type="text"
                name="confirmed"
              />
            </div>
          </div>

          <!-- Recovered -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("recovered")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.recovered"
                class="form-control"
                type="text"
                name="recovered"
              />
            </div>
          </div>

           <!-- Deaths -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("deaths")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.deaths"
                class="form-control"
                type="text"
                name="deaths"
              />
            </div>
          </div>

           <!-- Active -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("active")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.active"
                class="form-control"
                type="text"
                name="active"
              />
            </div>
          </div>

             <!-- Lat -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("lat")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.lat"
                class="form-control"
                type="text"
                name="lat"
              />
            </div>
          </div>

            <!-- Long -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("long")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.long"
                class="form-control"
                type="text"
                name="long"
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
      div_name: "",
      administrative_atoll: "",
      confirmed: "",
      recovered: "",
      deaths: "",
      active: "",
      lat: "",
      long: ""
    }),
    perPage: 10,
    currentPage: 1,
    pageOptions: [5, 10, 15, 20],
    keyword: "",
    dataArray: [],
    fields: [
      {
        key: "name",
        label: "Name",
        sortable: true
      },
      {
        key: "administrative_atoll",
        label: "Atoll",
        sortable: true
      },
      {
        key: "confirmed",
        label: "Confirmed",
        sortable: false
      },
      {
        key: "recovered",
        label: " Recovered",
        sortable: false
      },
      {
        key: "active",
        label: " Active",
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
      .get("/api/maldives")
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
    async AddMaldivesData() {
      // Add Test
      let response = await this.form.post("/api/maldives");

      this.dataArray.push(response.data.data);

      //Set flash message
      this.message = `${
        response.data.data.id
      } MaldivesData has been added to the database!`;

      //Reset the form
      this.form.reset();
    },

    async UpdateMaldivesData(data) {
      this.form.fill(data);

      let response = await this.form.put("/api/maldives/" + data.id);

      //Set flash message
      this.message = `MaldivesData ${data.id} has been updated`;

      //Reset the form
      this.form.reset();
    },

    async DestroyMaldivesData(id) {
      let response = this.form.delete("/api/maldives/" + id);

      this.dataArray = this.dataArray.filter(function(response) {
        return response.id !== id;
      });
      this.message = `MaldivesData with id of ${id} has been deleted`;
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
