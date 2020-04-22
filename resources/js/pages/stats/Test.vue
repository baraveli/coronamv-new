<template>
  <card :title="$t('test')">
    <form @submit.prevent="AddTest" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="message" />

      <!-- Total Tested -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("total_tested")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.total_tested"
            :class="{ 'is-invalid': form.errors.has('total_tested') }"
            class="form-control"
            type="text"
            name="total_tested"
          />
          <has-error :form="form" field="total_tested" />
        </div>
      </div>

      <!-- Total Positive -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("total_positive")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.total_positive"
            :class="{ 'is-invalid': form.errors.has('total_positive') }"
            class="form-control"
            type="text"
            name="total_positive"
          />
          <has-error :form="form" field="total_positive" />
        </div>
      </div>

      <!-- Total Negative -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("total_negative")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.total_negative"
            :class="{ 'is-invalid': form.errors.has('total_negative') }"
            class="form-control"
            type="text"
            name="total_negative"
          />
          <has-error :form="form" field="total_negative" />
        </div>
      </div>

      <!-- Total Pending -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("total_pending")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.total_pending"
            :class="{ 'is-invalid': form.errors.has('total_pending') }"
            class="form-control"
            type="text"
            name="total_pending"
          />
          <has-error :form="form" field="total_pending" />
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
          @click="DestroyTest(row.item.id)"
          class="mr-1"
        >
          Delete
        </b-button>

        <b-modal
          v-model="modalShow"
          title="Edit a Test"
          @ok="UpdateTest(modalData)"
        >
          <h5 style="color: red;">
            Tests ID: <span v-text="modalData.id"></span>
          </h5>
          <!-- Tested -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("total_tested")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.total_tested"
                class="form-control"
                type="text"
                name="total_tested"
              />
            </div>
          </div>

          <!-- Positive -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("total_positive")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.total_positive"
                class="form-control"
                type="text"
                name="total_positive"
              />
            </div>
          </div>

          <!-- Negative -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("total_negative")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.total_negative"
                class="form-control"
                type="text"
                name="total_negative"
              />
            </div>
          </div>

          <!-- Pending -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("total_pending")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.total_pending"
                class="form-control"
                type="text"
                name="total_pending"
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
      total_tested: "",
      total_positive: "",
      total_negative: "",
      total_pending: ""
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
        key: "total_tested",
        label: "Tested",
        sortable: true
      },
      {
        key: "total_positive",
        label: "Positive",
        sortable: true
      },
      {
        key: "total_negative",
        label: "Negative",
        sortable: true
      },
      {
        key: "total_pending",
        label: " Pending",
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
      .get("/api/tests")
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
    async AddTest() {
      // Add Test
      let response = await this.form.post("/api/tests");

      this.dataArray.push(response.data.data);

      //Set flash message
      this.message = `${
        response.data.data.id
      } Test has been added to the database!`;

      //Reset the form
      this.form.reset();
    },

    async UpdateTest(test) {
      this.form.fill(test);

      let response = await this.form.put("/api/tests/" + test.id);

      //Set flash message
      this.message = `Test ${test.id} has been updated`;

      //Reset the form
      this.form.reset();
    },

    async DestroyTest(id) {
      let response = this.form.delete("/api/tests/" + id);

      this.dataArray = this.dataArray.filter(function(response) {
        return response.id !== id;
      });
      this.message = `Test with id of ${id} has been deleted`;
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
