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

    it("add new pegawai valid", () => {
        cy.get(".button-action > .btn").click();
        cy.get("#namapegawai").type("pegawai Baru");
        cy.get("#tanggallahir").type("2000-01-01");
        cy.get(":nth-child(5) > .form-control").select(1);
        cy.get("#email").type("pegawaiBaru@mail.com");
        cy.get("#alamat").type("Jl. pegawai Baru");
        cy.get("#nomorhandphone").type(
            "081234567890"
        );
        cy.get("#kualifikasi").type("Pegawai Baru");

        cy.get(".select2-selection").click();
        cy.get(".select2-results__option").eq(0).click();
        cy.get(".content > :nth-child(1)").click();

        cy.get("#username").type("pegawaiBaru");
        cy.get("#password").type("12345");
        cy.get(".btn-primary").click();
        cy.contains("Pegawai berhasil ditambahkan").should("exist");
    });

    it("add new pegawai invalid empty input", () => {
        cy.get(".button-action > .btn").click();
        cy.get("#namapegawai:invalid")
            .invoke("prop", "validationMessage")
            .should("contain", "Please fill in this field");
    });

    it("add new pegawai invalid tanggal lahir more than today", () => {
        cy.get(".button-action > .btn").click();
        cy.get("#namapegawai").type("pegawai Baru");
        cy.get("#tanggallahir").type("2025-05-05");
        cy.get(":nth-child(5) > .form-control").select(1);
        cy.get("#email").type("employee1@mail.com");
        cy.get("#alamat").type("Jl. pegawai Baru");
        cy.get("#nomorhandphone").type(
            "081234567890"
        );
        cy.get("#kualifikasi").type("Pegawai Baru");

        cy.get(".select2-selection").click();
        cy.get(".select2-results__option").eq(0).click();
        cy.get(".content > :nth-child(1)").click();

        cy.get("#username").type("pegawaiBaru");
        cy.get("#password").type("12345");
        cy.get(".btn-primary").click();
        cy.contains("Tanggal lahir tidak boleh lebih dari hari ini").should(
            "exist"
        );
    });

    it("add new pegawai invalid same email", () => {
        cy.get(".button-action > .btn").click();
        cy.get("#namapegawai").type("pegawai Baru");
        cy.get("#tanggallahir").type("2000-01-01");
        cy.get(":nth-child(5) > .form-control").select(1);
        cy.get("#email").type("superadmin@mail.com");
        cy.get("#alamat").type("Jl. pegawai Baru");
        cy.get("#nomorhandphone").type(
            "081234567890"
        );
        cy.get("#kualifikasi").type("Pegawai Baru");

        cy.get(".select2-selection").click();
        cy.get(".select2-results__option").eq(0).click();
        cy.get(".content > :nth-child(1)").click();

        cy.get("#username").type("pegawaiBaru");
        cy.get("#password").type("12345");
        cy.get(".btn-primary").click();
        cy.contains("The email has already been taken").should("exist");
    });

    it("edit pegawai valid", () => {
        cy.get(
            ":nth-child(1) > .project-actions > form > .btn-warning"
        ).click();
        cy.get("#namapegawai").clear().type("pegawai Lama");
        cy.get("#tanggallahir").type("2000-05-05");
        cy.get(".btn-primary").click();
        cy.contains("Pegawai berhasil diupdate").should("exist");
    });

    it("edit pegawai tanggal lahir more than today", () => {
        cy.get(
            ":nth-child(1) > .project-actions > form > .btn-warning"
        ).click();
        cy.get("#tanggallahir").type("2025-05-05");
        cy.get(".btn-primary").click();
        cy.contains("Tanggal lahir tidak boleh lebih dari hari ini").should(
            "exist"
        );
    });

    it("delete pegawai", () => {
        cy.get(":nth-child(1) > .project-actions > form > .btn-danger").click();
        cy.contains("Pegawai berhasil dihapus").should("exist");
    });
});
