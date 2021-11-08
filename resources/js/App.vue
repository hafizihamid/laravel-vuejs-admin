<template>
  <div id="app">
    <nav-bar />
    <aside-menu :menu="menu" />
    <router-view />
    <footer-bar />
  </div>
</template>

<script>
// @ is an alias to /src
import NavBar from "@/components/NavBar";
import AsideMenu from "@/components/AsideMenu";
import FooterBar from "@/components/FooterBar";

export default {
  name: "home",
  components: {
    FooterBar,
    AsideMenu,
    NavBar
  },
  computed: {
    menu() {
      return [
        "General",
        [
          {
            to: "/",
            icon: "desktop-mac",
            label: "Dashboard"
          }
        ],
        "Menu",
        [
          {
            to: "/clients/index",
            label: "My Profile",
            icon: "account-multiple"
          },
          {
            label: "Super Admin",
            subLabel: "Super Admin",
            icon: "account-lock",
            menu: [
              {
                href: "#void",
                label: "SMS Log"
              },
              {
                href: "#void",
                label: "Call Log"
              },
              {
                href: "#void",
                label: "Schedule SMS"
              },
              {
                href: "#void",
                label: "Variables Configuration"
              },
              {
                href: "#void",
                label: "Settings Configuration"
              }
            ]
          },
          {
            label: "Users",
            subLabel: "Users",
            icon: "account",
            menu: [
              {
                href: "#void",
                label: "List of All Users"
              },
              {
                href: "#void",
                label: "Insert New User"
              },
              {
                href: "#void",
                label: "List of All Groups"
              },
              {
                href: "#void",
                label: "Insert New Group"
              }
            ]
          },
          {
            label: "Expenses",
            subLabel: "Expenses",
            icon: "cash",
            menu: [
              {
                href: "#void",
                label: "List of Expenses"
              },
              {
                href: "#void",
                label: "Insert New Expenses"
              }
            ]
          },
          {
            label: "Reporting",
            subLabel: "Reporting",
            icon: "file-chart-outline",
            menu: [
              {
                href: "#void",
                label: "Credit Term Reporting"
              },
              {
                href: "#void",
                label: "Payment Reporting"
              },
              {
                href: "#void",
                label: "Sales Reporting"
              },
              {
                href: "#void",
                label: "All Sales Reporting"
              },
              {
                href: "#void",
                label: "Yearly Sales Reporting"
              },
              {
                href: "#void",
                label: "Tracking Number"
              },
              {
                href: "#void",
                label: "List Of Customer"
              },
              {
                href: "#void",
                label: "Download Contacts"
              },
              {
                href: "#void",
                label: "Download All Contacts"
              }
            ]
          },
          {
            label: "Sales",
            subLabel: "Sales",
            icon: "sale",
            menu: [
              {
                href: "#void",
                label: "List Manual Sales Record"
              },
              {
                href: "#void",
                label: "Insert Manual Sales"
              },
              {
                href: "#void",
                label: "List C.O.D Record"
              },
              {
                href: "#void",
                label: "Insert C.O.D Record"
              }
            ]
          },
          {
            label: "Products",
            subLabel: "Products",
            icon: "shopping",
            menu: [
              {
                href: "#void",
                label: "List of Products"
              },
              {
                href: "#void",
                label: "Insert New Product"
              }
            ]
          },
          {
            label: "Print",
            subLabel: "Print",
            icon: "printer",
            menu: [
              {
                href: "#void",
                label: "Print Consingment Note"
              },
              {
                href: "#void",
                label: "List Of Address"
              },
              {
                href: "#void",
                label: "Insert New Address"
              }
            ]
          },
          {
            label: "SMS",
            subLabel: "SMS",
            icon: "message",
            menu: [
              {
                href: "#void",
                label: "List of All Messages"
              },
              {
                href: "#void",
                label: "Extract SMS Message"
              },
              {
                href: "#void",
                label: "Follow Up Message"
              },
              {
                href: "#void",
                label: "Auto scheduled SMS"
              },
              {
                href: "#void",
                label: "SMS Statistic"
              }
            ]
          }
          // {
          //   to: "/clients/index",
          //   label: "Print",
          //   icon: "printer"
          //   // updateMark: true
          // },
          // {
          //   to: "/clients/index",
          //   label: "Clients",
          //   icon: "account-multiple"
          //   // updateMark: true
          // },
          // {
          //   to: "/clients/index",
          //   label: "Clients",
          //   icon: "account-multiple"
          //   // updateMark: true
          // },
          // {
          //   to: "/clients/index",
          //   label: "Clients",
          //   icon: "account-multiple"
          //   // updateMark: true
          // },
          // {
          //   to: "/clients/index",
          //   label: "Clients",
          //   icon: "account-multiple"
          //   // updateMark: true
          // }
        ]
        // "Examples",
        // [
        //   {
        //     to: "/tables",
        //     label: "Tables",
        //     icon: "table"
        //   },
        //   {
        //     to: "/forms",
        //     label: "Forms",
        //     icon: "square-edit-outline"
        //   },
        //   {
        //     to: "/profile",
        //     label: "Profile",
        //     icon: "account-circle"
        //   },
        //   {
        //     label: "Submenus",
        //     subLabel: "Submenus Example",
        //     icon: "view-list",
        //     menu: [
        //       {
        //         href: "#void",
        //         label: "Sub-item One"
        //       },
        //       {
        //         href: "#void",
        //         label: "Sub-item Two"
        //       }
        //     ]
        //   }
        // ],
        // "About",
        // [
        //   {
        //     href: "https://admin-one-laravel.justboil.me",
        //     label: "Premium Demo",
        //     icon: "credit-card"
        //   },
        //   {
        //     href: "https://justboil.me/bulma-admin-template/one",
        //     label: "About",
        //     icon: "help-circle"
        //   }
        // ]
      ];
    }
  },
  created() {
    axios
      .get("/user")
      .then(r => {
        this.$store.commit("user", r.data.data);
      })
      .catch(err => {
        this.$buefy.toast.open({
          message: `Error: ${err.message}`,
          type: "is-danger"
        });
      });
  }
};
</script>
