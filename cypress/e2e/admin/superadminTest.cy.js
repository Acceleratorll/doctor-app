Cypress.on("uncaught:exception", (err, runnable) => {
    return false;
});

describe("pegawai testing", () => {
    beforeEach(() => {
        cy.visit("http://127.0.0.1:8000/login");

        cy.get('input[name="email"]').type("superadmin@mail.com");
        cy.get('input[name="password"]').type("12345");
        cy.get("form").submit();

        cy.url().should("include", "/admin/dashboard");
        cy.visit("http://127.0.0.1:8000/admin/pegawai");
    });

    it("see list of pegawai", () => {
        cy.contains("Nama Pegawai").should("exist");
    });
});