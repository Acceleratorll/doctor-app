Cypress.on("uncaught:exception", (err, runnable) => {
    return false;
});

describe("empty spec", () => {
    it("login as superadmin", () => {
        cy.visit("http://127.0.0.1:8000/login");

        cy.get('input[name="email"]').type("superadmin@mail.com");
        cy.get('input[name="password"]').type("12345");
        cy.get("form").submit();

        cy.url().should("include", "/admin/dashboard");
    });
    it("login as pasien", () => {
        cy.visit("http://127.0.0.1:8000/login");

        cy.get('input[name="email"]').type("pasien@mail.com");
        cy.get('input[name="password"]').type("12345");
        cy.get("form").submit();

        cy.url().should("include", "/dashboard");
    });
});
