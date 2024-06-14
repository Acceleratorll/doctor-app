Cypress.on("uncaught:exception", (err, runnable) => {
    return false;
});

describe("Reservation Test", () => {
    beforeEach(() => {
        cy.visit("http://127.0.0.1:8000/login");

        cy.get('input[name="email"]').type("superadmin@mail.com");
        cy.get('input[name="password"]').type("12345");
        cy.get("form").submit();

        cy.url().should("include", "/admin/dashboard");
    });

    it("create reservation approved", () => {
        cy.visit("http://127.0.0.1:8000/admin/reservation/create");
        cy.get("#bukti_pembayaran").selectFile("D:/Assets/Icons/gradient.jpg");
        cy.get("#approve").select("Approved");
        cy.get('select[name="schedule_id"]').select(1, { force: true });
        cy.get('select[name="patient_id"]').select(0, { force: true });
        cy.get(".btn-primary").click();
        cy.visit("http://127.0.0.1:8000/admin/reservation/create");
        cy.get("#bukti_pembayaran").selectFile("D:/Assets/Icons/gradient.jpg");
        cy.get("#approve").select("Approved");
        cy.get('select[name="schedule_id"]').select(1, { force: true });
        cy.get('select[name="patient_id"]').select(0, { force: true });
        cy.get(".btn-primary").click();
        cy.visit("http://127.0.0.1:8000/admin/reservation/create");
        cy.get("#bukti_pembayaran").selectFile("D:/Assets/Icons/gradient.jpg");
        cy.get("#approve").select("Approved");
        cy.get('select[name="schedule_id"]').select(4, { force: true });
        cy.get('select[name="patient_id"]').select(1, { force: true });
        cy.get(".btn-primary").click();
        cy.visit("http://127.0.0.1:8000/admin/reservation/create");
        cy.get("#bukti_pembayaran").selectFile("D:/Assets/Icons/gradient.jpg");
        cy.get("#approve").select("Approved");
        cy.get('select[name="schedule_id"]').select(4, { force: true });
        cy.get('select[name="patient_id"]').select(1, { force: true });
        cy.get(".btn-primary").click();
        cy.visit("http://127.0.0.1:8000/admin/reservation/create");
        cy.get("#bukti_pembayaran").selectFile("D:/Assets/Icons/gradient.jpg");
        cy.get("#approve").select("Approved");
        cy.get('select[name="schedule_id"]').select(4, { force: true });
        cy.get('select[name="patient_id"]').select(1, { force: true });
        cy.get(".btn-primary").click();
        cy.contains("Reservation berhasil dibuat").should("exist");
    });

    it("create reservation bpjs waiting", () => {
        cy.visit("http://127.0.0.1:8000/admin/reservation/create");
        cy.get("#bpjsCheckbox").click();
        cy.get(
            "#bpjsFieldsContainer > :nth-child(1) > .form-control"
        ).selectFile("D:/Assets/Icons/gradient.jpg");

        cy.get(
            "#bpjsFieldsContainer > :nth-child(2) > .form-control"
        ).selectFile("D:/Assets/Icons/unnamed.png");

        cy.get(
            "#bpjsFieldsContainer > :nth-child(3) > .form-control"
        ).selectFile("D:/Assets/Icons/bank-building.png");

        cy.get('select[name="schedule_id"]').select(1, { force: true });
        cy.get('select[name="patient_id"]').select(0, { force: true });

        cy.get(".btn-primary").click();
        cy.visit("http://127.0.0.1:8000/admin/reservation/create");
        cy.get("#bpjsCheckbox").click();
        cy.get(
            "#bpjsFieldsContainer > :nth-child(1) > .form-control"
        ).selectFile("D:/Assets/Icons/gradient.jpg");
        cy.get('select[name="schedule_id"]').select(1, { force: true });
        cy.get('select[name="patient_id"]').select(0, { force: true });

        cy.get(
            "#bpjsFieldsContainer > :nth-child(2) > .form-control"
        ).selectFile("D:/Assets/Icons/unnamed.png");

        cy.get(
            "#bpjsFieldsContainer > :nth-child(3) > .form-control"
        ).selectFile("D:/titipan_mas_riski/7.png");

        cy.get(".btn-primary").click();
        cy.contains("Reservation berhasil dibuat").should("exist");
    });

    it("create reservation invalid", () => {
        cy.visit("http://127.0.0.1:8000/admin/reservation/create");
        cy.get('select[name="schedule_id"]').select(3, { force: true });
        cy.get('select[name="patient_id"]').select(0, { force: true });
        cy.get(".btn-primary").click();
        cy.contains(
            "Maaf, kamu tidak dapat menambah reservasi karena terdapat data yang kosong atau tidak tepat"
        ).should("exist");
    });

    it("create reservation qty is full", () => {
        cy.visit("http://127.0.0.1:8000/admin/reservation/create");
        cy.get('select[name="schedule_id"]').select(7, { force: true });
        cy.get('select[name="patient_id"]').select(0, { force: true });
        cy.get("#bukti_pembayaran").selectFile("D:/Assets/Icons/gradient.jpg");
        cy.get("#approve").select("Approved");
        cy.get(".btn-primary").click();
        cy.contains(
            "Maaf, kamu tidak dapat menambah reservasi karena kuota sudah penuh"
        ).should("exist");
    });

    it("Approve waiting reservation", () => {
        cy.visit("http://127.0.0.1:8000/admin/waiting-list");
        cy.get(
            ":nth-child(1) > .project-actions > .d-flex > #approve-form > .btn > .fa"
        ).click();
        cy.get(".swal2-confirm").click();

        cy.contains("Reservation approved successfully").should("exist");
    });

    it("Reject waiting reservation", () => {
        cy.visit("http://127.0.0.1:8000/admin/waiting-list");
        cy.get("#reject").click();
        cy.get("#swal2-textarea").type("Alasan ditolak karena keterlambatan");
        cy.get(".swal2-confirm").click();

        cy.get(".swal2-popup").should("exist");
    });

    it("edit reservation valid without change image", () => {
        cy.visit("http://127.0.0.1:8000/admin/reservation/");
        cy.get(
            ":nth-child(1) > .project-actions > .d-flex > .btn-warning"
        ).click();
        cy.get("select[name='schedule_id']").select(2, { force: true });
        cy.get(".btn-primary").click();
        cy.contains("Reservation berhasil diubah").should("exist");
    });

    it("edit reservation valid with change image", () => {
        cy.visit("http://127.0.0.1:8000/admin/reservation/");
        cy.get(
            ":nth-child(1) > .project-actions > .d-flex > .btn-warning"
        ).click();
        cy.get("#showBpjsCheckbox").click();
        cy.get("#bukti_pembayaran").selectFile("D:/Assets/Icons/unnamed.png");
        cy.get("select[name='patient_id']").select("Pasien 2", { force: true });
        cy.get("select[name='schedule_id']").select(3, { force: true });
        cy.get(".btn-primary").click();
        cy.contains("Reservation berhasil diubah").should("exist");
    });

    it("edit reservation invalid", () => {
        cy.visit("http://127.0.0.1:8000/admin/reservation/");
        cy.get(
            ":nth-child(1) > .project-actions > .d-flex > .btn-warning"
        ).click();
        cy.get("#showBpjsCheckbox").click();
        cy.get("select[name='patient_id']").select("Pasien 2", { force: true });
        cy.get("select[name='schedule_id']").select(3, { force: true });
        cy.get(".btn-primary").click();
        cy.contains(
            "Maaf, kamu tidak dapat mengedit reservasi karena terdapat data yang kosong atau tidak tepat"
        ).should("exist");
    });

    it("delete reservation valid", () => {
        cy.visit("http://127.0.0.1:8000/admin/reservation/");
        cy.get(
            ":nth-child(1) > .project-actions > .d-flex > .btn-danger"
        ).click();
        cy.get('.swal2-confirm').click();
        cy.contains(
            "Reservasi berhasil dihapus"
        ).should("exist");
    });

    it("delete reservation invalid", () => {
        cy.visit("http://127.0.0.1:8000/admin/reservation/");
        cy.get(
            ":nth-child(1) > .project-actions > .d-flex > .btn-danger"
        ).click();
        cy.get('.swal2-cancel').click();
    });
});
