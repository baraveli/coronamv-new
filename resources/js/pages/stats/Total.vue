<template>
  <card :title="$t('total')">
    <form @submit.prevent="addtotals" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="message" />

      <!-- Total Confirmed -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("total_confirmed")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.total_confirmed"
            :class="{ 'is-invalid': form.errors.has('total_confirmed') }"
            class="form-control"
            type="text"
            name="total_confirmed"
          />
          <has-error :form="form" field="total_confirmed" />
        </div>
      </div>

      <!-- Total Recovered -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("total_recovered")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.total_recovered"
            :class="{ 'is-invalid': form.errors.has('total_recovered') }"
            class="form-control"
            type="text"
            name="total_recovered"
          />
          <has-error :form="form" field="total_recovered" />
        </div>
      </div>

      <!-- Total Active -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("total_active")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.total_active"
            :class="{ 'is-invalid': form.errors.has('total_active') }"
            class="form-control"
            type="text"
            name="total_active"
          />
          <has-error :form="form" field="total_active" />
        </div>
      </div>

      <!-- Total Death -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("total_death")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.total_death"
            :class="{ 'is-invalid': form.errors.has('total_death') }"
            class="form-control"
            type="text"
            name="total_death"
          />
          <has-error :form="form" field="total_death" />
        </div>
      </div>

      <!-- Local Confirmed -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("local_confirmed")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.local_confirmed"
            :class="{ 'is-invalid': form.errors.has('local_confirmed') }"
            class="form-control"
            type="text"
            name="local_confirmed"
          />
          <has-error :form="form" field="local_confirmed" />
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
          @click="DestroyTotal(row.item.id)"
          class="mr-1"
        >
          Delete
        </b-button>

        <b-modal
          v-model="modalShow"
          title="Edit a Total"
          @ok="UpdateTotal(modalData)"
        >
          <h5 style="color: red;">
            Total ID: <span v-text="modalData.id"></span>
          </h5>
          <!-- Confirmed -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("total_confirmed")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.total_confirmed"
                class="form-control"
                type="text"
                name="total_confirmed"
              />
            </div>
          </div>

          <!-- Recovered -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("total_recovered")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.total_recovered"
                class="form-control"
                type="text"
                name="total_recovered"
              />
            </div>
          </div>

          <!-- Active -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("total_active")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.total_active"
                class="form-control"
                type="text"
                name="total_active"
              />
            </div>
          </div>

          <!-- Death -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("total_death")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.total_death"
                class="form-control"
                type="text"
                name="total_death"
              />
            </div>
          </div>

          <!-- Local -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("local_confirmed")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.local_confirmed"
                class="form-control"
                type="text"
                name="local_confirmed"
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
      total_confirmed: "",
      total_recovered: "",
      total_active: "",
      total_death: "",
      local_confirmed: ""
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
        key: "total_confirmed",
        label: "Confirmed",
        sortable: true
      },
      {
        key: "total_recovered",
        label: "Recovered",
        sortable: true
      },
      {
        key: "total_active",
        label: "Active",
        sortable: true
      },
      {
        key: "total_death",
        label: " Deaths",
        sortable: true
      },
      {
        key: "local_confirmed",
        label: "Local",
        sortable: true
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
      .get("/api/totals")
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
    async addtotals() {
      // Add Total
      let response = await this.form.post("/api/totals");

      this.dataArray.push(response.data.data);

      //Set flash message
      this.message = `${
        response.data.data.id
      } Total has been added to the database!`;

      //Reset the form
      this.form.reset();
    },

    async UpdateTotal(total) {
      this.form.fill(total);

      let response = await this.form.put("/api/totals/" + total.id);

      //Set flash message
      this.message = `Total ${total.id} has been updated`;

      //Reset the form
      this.form.reset();
    },

    async DestroyTotal(id) {
      let response = this.form.delete("/api/totals/" + id);


      this.dataArray = this.dataArray.filter(function(response) {
        return response.id !== id;
      });
      this.message = `Total with id of ${id} has been deleted`;
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
