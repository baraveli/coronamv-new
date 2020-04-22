<div class="shadow-sm p-3 mt-2 bg-white rounded">

              <b-input-group class="mt-3 mb-3" size="sm">
                <b-form-input v-model="keyword" placeholder="Search" type="text" style="background-color: #F4F4F4;">
                </b-form-input>

                <div class="col-3 mb-2">

                  <b-form-select v-model="perPage" id="perPageSelect" size="sm" :options="pageOptions"
                    style="background-color: #F4F4F4;"></b-form-select>
                </div>

              </b-input-group>




              <b-table head-variant="dark" class="divtype o-90" :fields="fields" :items="items" :per-page="perPage"
                :current-page="currentPage" :keyword="keyword"></b-table>

              <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage" aria-controls="my-table" pills
                limit="6"></b-pagination>

              <div>
                <p class="o-70"> @{{entries}}</p>
              </div>



            </div>