Cypress.on("uncaught:exception", (err, runnable) => {
    return false;
});

describe("announcement testing", () => {
    beforeEach(() => {
        cy.visit("http://127.0.0.1:8000/login");

        cy.get('input[name="email"]').type("superadmin@mail.com");
        cy.get('input[name="password"]').type("12345");
        cy.get("form").submit();

        cy.url().should("include", "/admin/dashboard");
    });

    it("see list of announcement", () => {
        cy.visit("http://127.0.0.1:8000/admin/pengumuman");
    });

    it("add new announcement", () => {
        cy.visit("http://127.0.0.1:8000/admin/pengumuman");
        cy.get(".button-action > .btn").click();
        cy.get(":nth-child(2) > .col > .form-group > .form-control").type("Title of Announcement");
        cy.get(":nth-child(3) > .col > .form-group > #linkmaps").type(
          "Thank you using our services. Today announcement is that new feature have been added to this website. so please using it as soon as you can. if there is any problem please contact us. Thank you. Stay Healthy!"
        );
        cy.get("#image").selectFile("D:/Assets/Icons/unnamed.png");

        cy.get(".btn-primary").click();

        cy.get(".button-action > .btn").click();
        cy.get(":nth-child(2) > .col > .form-group > .form-control").type("New Doctor");
        cy.get(":nth-child(3) > .col > .form-group > #linkmaps").type(
          "Thank you using our services. We have a new doctor that specialized in Skin Care. If you have any question or suggestion to a new doctor, please make a reservation in layanan page. Thank you. Stay Dehidrated and Healthy!"
        );

        cy.get("#image").selectFile("D:/Assets/Icons/unnamed.png");

        cy.get(".btn-primary").click();
        cy.contains("Pengumuman berhasil ditambahkan").should('exist');
    });

    it("broadcast announcement", () => {
      cy.visit("http://127.0.0.1:8000/admin/pengumuman");
      cy.get(":nth-child(1) > .project-actions > form > .btn-warning").click();
      cy.contains("Pengumuman berhasil di broadcast").should('exist');
    });

    it("edit announcement", () => {
      cy.visit("http://127.0.0.1:8000/admin/pengumuman");
      cy.get(":nth-child(1) > .project-actions > form > .btn-info").click();
      cy.get(":nth-child(3) > .col > .form-group > .form-control").clear().type("Now You Can Check Your Skin Health with Us");
      cy.get(".btn-primary").click();
      cy.contains("Pengumuman berhasil diupdate").should("exist");
    });

    it("delete announcement", () => {
      cy.visit("http://127.0.0.1:8000/admin/pengumuman");
      cy.get(":nth-child(2) > .project-actions > form > .btn-danger").click();
      cy.contains("Pengumuman berhasil dihapus").should("exist");
    });

    it("add new announcement invalid", () => {
        cy.visit("http://127.0.0.1:8000/admin/pengumuman");
        cy.get(".button-action > .btn").click();
        cy.get(":nth-child(2) > .col > .form-group > .form-control")
            .invoke("prop", "validationMessage")
            .should("equal", "Please fill in this field.");

        cy.get(":nth-child(3) > .col > .form-group > #linkmaps")
            .invoke("prop", "validationMessage")
            .should("equal", "Please fill in this field.");

        cy.get(".btn-primary").click();
    });
});
