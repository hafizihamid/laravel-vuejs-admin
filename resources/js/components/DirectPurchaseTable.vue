<template>
  <div>
    <modal-box
      :is-active="isModalActive"
      :trash-object-name="trashObjectName"
      @confirm="trashConfirm"
      @cancel="trashCancel"
    />
    <b-table
      :checked-rows.sync="checkedRows"
      :checkable="checkable"
      :loading="isLoading"
      :paginated="paginated"
      :per-page="perPage"
      :striped="true"
      :hoverable="true"
      default-sort="name"
      :data="clients"
    >
      <b-table-column
        label="Staff Name"
        field="membername"
        sortable
        v-slot="props"
      >
        {{ props.row.membername }}
      </b-table-column>

      <b-table-column label="Total" field="counted" sortable v-slot="props">
        {{ props.row.counted }}
      </b-table-column>

      <section slot="empty" class="section">
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
  </div>
</template>

<script>
import ModalBox from "@/components/ModalBox";

export default {
  name: "DirectPurchaseTable",
  components: { ModalBox },
  props: {
    dataUrl: {
      type: String,
      default: null
    },
    checkable: {
      type: Boolean,
      default: false
    }
  },
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
    trashObjectName() {
      if (this.trashObject) {
        return this.trashObject.name;
      }

      return null;
    }
  },
  created() {
    this.getData();
  },
  methods: {
    getData() {
      if (this.dataUrl) {
        this.isLoading = true;
        axios
          .get(this.dataUrl)
          .then(r => {
            this.isLoading = false;
            if (r.data && r.data.data) {
              if (r.data.data.length > this.perPage) {
                this.paginated = true;
              }
              this.clients = r.data.data;
            }
          })
          .catch(err => {
            this.isLoading = false;
            this.$buefy.toast.open({
              message: `Error: ${e.message}`,
              type: "is-danger",
              queue: false
            });
          });
      }
    },
    trashModal(trashObject) {
      this.trashObject = trashObject;
      this.isModalActive = true;
    },
    trashConfirm() {
      this.isModalActive = false;

      axios
        .delete(`/clients/${this.trashObject.id}/destroy`)
        .then(r => {
          this.getData();

          this.$buefy.snackbar.open({
            message: `Deleted ${this.trashObject.name}`,
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
