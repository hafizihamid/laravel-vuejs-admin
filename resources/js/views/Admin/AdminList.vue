<template>
  <div>
    <title-bar :title-stack="['Admin']" />
    <hero-bar>
      Users
      <router-link to="/clients/new" class="button" slot="right">
        New User
      </router-link>
    </hero-bar>
    <section class="section is-main-section">
      <card-component
        class="has-table has-mobile-sort-spaced"
        title="Users"
        icon="account-multiple"
      >
        <card-toolbar>
          <button
            slot="right"
            type="button"
            class="button is-danger is-small has-checked-rows-number"
            @click="trashModal(null)"
            :disabled="!checkedRows.length"
          >
            <b-icon icon="trash-can" custom-size="default" />
            <span>Delete</span>
            <span v-show="!!checkedRows.length"
              >({{ checkedRows.length }})</span
            >
          </button>
        </card-toolbar>

        <modal-box
          :is-active="isModalActive"
          :trash-object-name="trashSubject"
          @confirm="trashConfirm"
          @cancel="trashCancel"
        />

        <b-table
          :checked-rows.sync="checkedRows"
          :checkable="false"
          :loading="isLoading"
          :paginated="paginated"
          :per-page="perPage"
          :striped="true"
          :hoverable="true"
          default-sort="name"
          :data="clients"
        >
          <b-table-column label="No." field="index" sortable v-slot="props">
            {{ props.index + 1 }}
          </b-table-column>
          <b-table-column
            class="has-no-head-mobile is-image-cell"
            label="Name"
            field="membername"
            sortable
            v-slot="props"
          >
            {{ props.row.membername }}
          </b-table-column>

          <b-table-column
            label="Mobile No."
            field="mobile_no"
            sortable
            v-slot="props"
          >
            {{ props.row.mobile_no }}
          </b-table-column>

          <b-table-column label="Email" field="email" sortable v-slot="props">
            {{ props.row.email }}
          </b-table-column>

          <b-table-column
            label="Username"
            field="username"
            sortable
            v-slot="props"
          >
            {{ props.row.username }}
          </b-table-column>

          <b-table-column
            label="Level"
            field="membertype"
            sortable
            v-slot="props"
          >
            {{ props.row.membertype }}
          </b-table-column>

          <b-table-column label="Group" field="groupid" sortable v-slot="props">
            {{ props.row.group_name }}
          </b-table-column>

          <b-table-column
            label="Target(Qty)"
            field="qty_target"
            sortable
            v-slot="props"
          >
            {{ props.row.qty_target }}
          </b-table-column>

          <b-table-column
            label="Target(MYR)"
            field="sales_target"
            sortable
            v-slot="props"
          >
            {{ props.row.sales_target }}
          </b-table-column>

          <b-table-column
            label="Status"
            field="memberstatus"
            sortable
            v-slot="props"
          >
            {{ props.row.status }}
          </b-table-column>

          <b-table-column
            custom-key="actions"
            class="is-actions-cell"
            v-slot="props"
          >
            <div class="buttons is-right">
              <router-link
                :to="{ name: 'clients.edit', params: { id: props.row.id } }"
                class="button is-small is-primary"
              >
                <b-icon icon="account-edit" size="is-small" />
              </router-link>
              <button
                class="button is-small is-danger"
                type="button"
                @click.prevent="trashModal(props.row)"
              >
                <b-icon icon="trash-can" size="is-small" />
              </button>
            </div>
          </b-table-column>

          <section class="section" slot="empty">
            <div class="content has-text-grey has-text-centered">
              <template v-if="isLoading">
                <p>
                  <b-icon icon="dots-horizontal" size="is-large" />
                </p>
                <p>Fetching data...</p>
              </template>
              <template v-else>
                <p>
                  <b-icon icon="emoticon-sad" size="is-large" />
                </p>
                <p>Nothing's here&hellip;</p>
              </template>
            </div>
          </section>
        </b-table>
      </card-component>
    </section>
  </div>
</template>

<script>
import map from "lodash/map";
import CardComponent from "@/components/CardComponent";
import ModalBox from "@/components/ModalBox";
import TitleBar from "@/components/TitleBar";
import HeroBar from "@/components/HeroBar";
import CardToolbar from "@/components/CardToolbar";

export default {
  name: "AdminList",
  components: { CardToolbar, HeroBar, TitleBar, ModalBox, CardComponent },
  data() {
    return {
      isModalActive: false,
      trashObject: null,
      clients: [],
      isLoading: false,
      paginated: false,
      perPage: 10,
      checkedRows: []
    };
  },
  computed: {
    trashSubject() {
      if (this.trashObject) {
        return this.trashObject.name;
      }

      if (this.checkedRows.length) {
        return `${this.checkedRows.length} entries`;
      }

      return null;
    }
  },
  created() {
    this.getData();
  },
  methods: {
    getData() {
      this.isLoading = true;
      axios
        .get("/admin")
        .then(r => {
          this.isLoading = false;
          if (r.data && r.data.data) {
            if (r.data.data.length > this.perPage) {
              this.paginated = true;
            }
            this.clients = r.data.data;
            for (const element of this.clients) {
              if (element.memberstatus == 0) {
                element["status"] = "active";
              } else if (element.memberstatus == 1) {
                element["status"] = "blocked";
              } else {
                element["status"] = "need activation";
              }
            }
          }
        })
        .catch(err => {
          this.isLoading = false;
          this.$buefy.toast.open({
            message: `Error: ${err.message}`,
            type: "is-danger",
            queue: false
          });
        });
    },
    trashModal(trashObject = null) {
      if (trashObject || this.checkedRows.length) {
        this.trashObject = trashObject;
        this.isModalActive = true;
      }
    },
    trashConfirm() {
      let url;
      let method;
      let data = null;

      this.isModalActive = false;

      if (this.trashObject) {
        method = "delete";
        url = `/clients/${this.trashObject.id}/destroy`;
      } else if (this.checkedRows.length) {
        method = "post";
        url = "/clients/destroy";
        data = {
          ids: map(this.checkedRows, row => row.id)
        };
      }

      axios({
        method,
        url,
        data
      })
        .then(r => {
          this.getData();

          this.trashObject = null;
          this.checkedRows = [];

          this.$buefy.snackbar.open({
            message: `Deleted`,
            queue: false
          });
        })
        .catch(err => {
          this.$buefy.toast.open({
            message: `Error: ${err.message}`,
            type: "is-danger",
            queue: false
          });
        });
    },
    trashCancel() {
      this.isModalActive = false;
    }
  }
};
</script>
