<template>
  <card :title="$t('resources')">
    <form
      @submit.prevent="addResources"
      @keydown="form.onKeydown($event)"
      enctype="multipart/form-data"
    >
      <alert-success :form="form" :message="message" />

      <!-- title -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("title")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.title"
            :class="{ 'is-invalid': form.errors.has('title') }"
            class="form-control"
            type="text"
            name="title"
          />
          <has-error :form="form" field="title" />
        </div>
      </div>

      <!-- Body -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("body")
        }}</label>
        <div class="col-md-7">
          <textarea
            v-model="form.body"
            :class="{ 'is-invalid': form.errors.has('body') }"
            class="form-control"
            name="body"
          ></textarea>
          <has-error :form="form" field="body" />
        </div>
      </div>

      <!-- Resource Link -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("resourcelink")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.resource_link"
            :class="{ 'is-invalid': form.errors.has('resource_link') }"
            class="form-control"
            type="text"
            name="resource_link"
          />
          <has-error :form="form" field="resource_link" />
        </div>
      </div>

      <!-- Resource tag -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("resourcetag")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.resource_tag"
            :class="{ 'is-invalid': form.errors.has('resource_tag') }"
            class="form-control"
            type="text"
            name="resource_tag"
          />
          <has-error :form="form" field="resource_tag" />
        </div>
      </div>

      <!--  contact -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{
          $t("contact")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.contact"
            :class="{ 'is-invalid': form.errors.has('contact') }"
            class="form-control"
            type="text"
            name="contact"
          />
          <has-error :form="form" field="contact" />
        </div>
      </div>
      <!--  Image -->
      <div class="form-group row">
        <div class="col-md-7 offset-md-3 d-flex">
          <div v-if="!form.image">
            <h2>Select an image</h2>
            <input type="file" @change="onFileChange" />
          </div>

          <div v-else>
            <img class="img-thumbnail" :src="form.image" />
            <button @click="removeImage">Remove image</button>
          </div>
          <has-error :form="form" field="image" />
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
          @click="DestroyResource(row.item.id)"
          class="mr-1"
        >
          Delete
        </b-button>

        <b-modal
          v-model="modalShow"
          title="Edit a Resource"
          @ok="UpdateResource(modalData)"
        >
          <!-- Title -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("title")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.title"
                class="form-control"
                type="text"
                name="title"
              />
            </div>
          </div>

          <!-- Body -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("body")
            }}</label>
            <div class="col-md-7">
              <textarea
                v-model="modalData.body"
                class="form-control"
                name="title"
              >
              </textarea>
            </div>
          </div>

          <!-- Resource Link -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("resource_link")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.resource_link"
                class="form-control"
                type="text"
                name="resource_link"
              />
            </div>
          </div>

          <!-- Resource Tag -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("resource_tag")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.resource_tag"
                class="form-control"
                type="text"
                name="resource_tag"
              />
            </div>
          </div>

          <!-- Contact-->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("contact")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="modalData.contact"
                class="form-control"
                type="text"
                name="contact"
              />
            </div>
          </div>

          <!-- Image-->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("image")
            }}</label>
            <div class="col-md-7">
              <input type="file" @change="onFileChange" />
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

    <b-button variant="success" size="sm" @click="ExportCsv()" class="mr-1">
      Export to csv
    </b-button>
  </card>
</template>

<script>
import Form from "vform";
import { objectToFormData } from "object-to-formdata";
import axios from "axios";

export default {
  data: () => ({
    modalShow: false,
    modalData: [],
    message: "",
    form: new Form({
      title: "",
      body: "",
      image: "",
      resource_link: "",
      resource_tag: "",
      creator: "",
      contact: ""
    }),
    perPage: 10,
    currentPage: 1,
    pageOptions: [5, 10, 15, 20],
    keyword: "",
    dataArray: [],
    fields: [
      {
        key: "title",
        label: "Title",
        sortable: true
      },
      {
        key: "body",
        label: "Body",
        sortable: false,
        formatter: body => {
          return body.substring(0, 8);
        }
      },
      {
        key: "image",
        label: "Image",
        sortable: false,
        formatter: image => {
          return image.substring(0, 8);
        }
      },
      {
        key: "resource_link",
        label: "Link",
        sortable: false,
        formatter: link => {
          return link.substring(0, 8);
        }
      },
      {
        key: "resource_tag",
        label: "Tag",
        sortable: true
      },
      {
        key: "contact",
        label: "Contact",
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
      .get("/api/resources")
      .then(response => (this.dataArray = response.data.data.resources));
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
      this.modalData.image = "";
    },
    onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;

      this.createImage(files[0]);
    },
    createImage(file) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = e => {
        vm.form.image = e.target.result;
        vm.modalData.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },

    removeImage: function(e) {
      this.form.image = "";
    },
    async addResources() {
      // Add resources
      let response = await this.form.post("/api/resources", {
        transformRequest: [
          function(data, headers) {
            return objectToFormData(data);
          }
        ]
      });

      this.dataArray.push(response.data.data);

      //Flash a message
      this.message = `${
        response.data.data.title
      } has been added to the database!`;

      //Reset the form
      this.form.reset();
    },

    async UpdateResource(resource) {
      this.form.fill(resource);

      let response = await this.form.put("/api/resources/" + resource.id);

      //this.dataArray[resource.id].image = response.data.data.image;

      //Set flash message
      this.message = `Resource ${resource.id} has been updated`;

      //Reset the form
      this.form.reset();
    },

    async DestroyResource(id) {
      let response = await this.form.delete("/api/resources/" + id);

      this.dataArray = this.dataArray.filter(function(response) {
        return response.id !== id;
      });

      //Flash a message
      this.message = `ResourceID: ${id} has been deleted`;
    },

    ExportCsv() {
      axios({
        url: "/api/resources/export",
        method: "GET",
        responseType: "blob"
      }).then(response => {
        var fileURL = window.URL.createObjectURL(new Blob([response.data]));
        var fileLink = document.createElement("a");
        fileLink.href = fileURL;
        fileLink.setAttribute("download", "resource.csv");
        document.body.appendChild(fileLink);
        fileLink.click();
      });
    }
  }
};
</script>
