Cypress.on("uncaught:exception", (err, runnable) => {
    return false;
});

describe("dokter testing", () => {
    beforeEach(() => {
        cy.visit("http://127.0.0.1:8000/login");

        cy.get('input[name="email"]').type("superadmin@mail.com");
        cy.get('input[name="password"]').type("12345");
        cy.get("form").submit();

        cy.url().should("include", "/admin/dashboard");
        cy.visit("http://127.0.0.1:8000/admin/dokter");
    });

    it("see list of superadmin", () => {
        cy.contains("Nama Dokter").should("exist");
    });

    it("edit superadmin", () => {
        cy.get(".btn-warning").click();
        cy.get("#namadokter").clear().type("dr. Sutomo Surya Matahari");
        cy.get("#tanggallahir").type("2000-01-01");
        cy.get(":nth-child(6) > .form-control").select(1);
        cy.get("#email").clear().type("superadmin@mail.com");
        cy.get("#alamat").clear().type("Jl. dokter Baru");
        cy.get("#nomorhandphone").clear().type("081234567890");
        cy.get("#qualification").clear().type("dokter Baru");

        cy.get(".select2-selection").click();
        cy.get(".select2-results__option").eq(5).click();
        cy.get(".content > :nth-child(1)").click();

        cy.get("#username").clear().type("superadmin");
        cy.get(".btn-primary").click();
        cy.contains("Superadmin successfully updated").should('exist');
    });

    it("edit superadmin invalid empty input", () => {
        cy.get(".btn-warning").click();
        cy.get("#namadokter").clear();
        cy.get("#namadokter:invalid")
            .invoke("prop", "validationMessage")
            .should("contain", "Please fill in this field");
    });
});