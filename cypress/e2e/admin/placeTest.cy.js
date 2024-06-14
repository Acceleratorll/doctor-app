Cypress.on("uncaught:exception", (err, runnable) => {
    return false;
});

describe("place testing", () => {
    beforeEach(() => {
        cy.visit("http://127.0.0.1:8000/login");

        cy.get('input[name="email"]').type("superadmin@mail.com");
        cy.get('input[name="password"]').type("12345");
        cy.get("form").submit();

        cy.url().should("include", "/admin/dashboard");
        cy.visit("http://127.0.0.1:8000/admin/tempat");
    });

    // it("see list of place", () => {
    //     cy.contains("Nama Tempat").should("exist");
    // });

    // it("add tempat", () => {
    //     cy.get(".button-action > .btn").click();
    //     cy.get(".form-group > #linkmaps").type('Clinic Tong Fang');
    //     cy.get("#address").type("Jl. Tong Fang");
    //     cy.get(".btn-primary").click();
    //     cy.contains("Tempat created successfully").should("exist");
    // });

    // it("add tempat invalid input empty", () => {
    //     cy.get(".button-action > .btn").click();
    //     cy.get(".form-group > #linkmaps").type("Clinic Tong Fang");
    //     cy.get("#address").clear();
    //     cy.get("#address:invalid")
    //     .invoke("prop", "validationMessage")
    //     .should("contain", "Please fill in this field");
    // });

    // it("add tempat invalid place more than two", () => {
    //     cy.get(".button-action > .btn").click();
    //     cy.get(".form-group > #linkmaps").type("Clinic Mastah");
    //     cy.get("#address").type('Jl. Mastah');
    //     cy.get(".btn-primary").click();
    //     cy.contains('Maaf, tidak dapat menambahkan lebih dari 2 tempat').should('exist');
    // });

    // it("edit tempat", () => {
    //   cy.get(".odd > .project-actions > form > .btn-warning").click();
    //   cy.get(":nth-child(3) > .col > .form-group > .form-control").clear().type("New Clinic");
    //   cy.get('#address').clear().type('Jl. New Clinic');
    //   cy.get(".btn-primary").click();
    //   cy.contains("Tempat updated successfully").should("exist");
    // });

    // it("edit tempat invalid empty input", () => {
    //   cy.get(".odd > .project-actions > form > .btn-warning").click();
    //   cy.get(":nth-child(3) > .col > .form-group > .form-control").clear();
    //   cy.get(":nth-child(3) > .col > .form-group > .form-control")
    //     .invoke("prop", "validationMessage")
    //     .should("contain", "Please fill in this field");
    // });

    it("delete tempat", () => {
        // cy.get(".odd > .project-actions > form > .btn-danger").click();
        cy.contains("Tempat deleted successfully").should("exist");
    });
});
