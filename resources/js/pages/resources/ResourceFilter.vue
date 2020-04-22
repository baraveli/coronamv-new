<template>
  <card :title="$t('resourcefilter')">
    <form @submit.prevent="addfilter" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="message" />

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

      <!-- Sub -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("sub")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.sub"
            :class="{ 'is-invalid': form.errors.has('sub') }"
            class="form-control"
            type="text"
            name="sub"
          />
          <has-error :form="form" field="sub" />
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
          @click="DestroyResourceKey(row.item.id)"
          class="mr-1"
        >
          Delete
        </b-button>

        <b-modal v-model="modalShow" title="Edit a Resource Filter" @ok="UpdateResourceFilter(modalData)">
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

          <!-- Sub -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("sub")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.sub"
                class="form-control"
                type="text"
                name="sub"
              />
            </div>
          </div>
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

export default {
  data: () => ({
    modalShow: false,
    modalData: [],

    message: "",
    form: new Form({
      name: "",
      sub: ""
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
        key: "sub",
        label: "Sub",
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
      .get("/api/resource_filters")
      .then(response => (this.dataArray = response.data.data));
  },

  metaInfo() {
    return { title: this.$t("resources") };
  },

  methods: {
    ModalStateToggle() {
      this.modalShow = !this.modalShow;
    },

    SetModalData(item) {
      this.modalData = item;
    },
    async addfilter() {
      // Add resource filter
      let response = await this.form.post("/api/resource_filters");

      this.dataArray.push(response.data.data);

      //Set flash message
      this.message = `${response.data.data.name} Filter has been added to the database!`;

      //Reset the form
      this.form.reset();
    },

    async UpdateResourceFilter(resourcefilter) {
      this.form.fill(resourcefilter);

      let response = await this.form.put(
        "/api/resource_filters/" + resourcefilter.id
      );

      //Set flash message
      this.message = `Filter ${resourcefilter.id} has been updated`;

      //Reset the form
      this.form.reset();
    },

    async DestroyResourceKey(id) {
      let response = this.form.delete("/api/resource_filters/" + id);

      this.dataArray = this.dataArray.filter(function(response) {
        return response.id !== id;
      });
      this.message = `Filter ${id} has been deleted`;
    }
  }
};
</script>
