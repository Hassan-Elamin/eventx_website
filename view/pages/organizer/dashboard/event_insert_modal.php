<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <style>
                @media (min-width:576px) {
                    .modal {
                        --bs-modal-width: 600px;
                    }
                }

                .dates-inputs>* {
                    margin: 6px;
                }
            </style>
            <div class="modal-body">
                <form>
                    <div class="mb-6">
                        <label for="title" class="col-form-label">Title:</label>
                        <input type="text" class="form-control" id="title">
                    </div>
                    <div class="mb-6">
                        <label for="description-text" class="col-form-label">Description:</label>
                        <textarea class="form-control" id="description"></textarea>
                    </div>
                    <div class="d-flex flex-row justify-content-between dates-inputs">
                        <div>
                            <label for="start_at" class="col-form-label">Start At</label>
                            <input type="datetime-local" class="form-control" id="start_at">
                        </div>
                        <div>
                            <label for="end_at" class="col-form-label">End At</label>
                            <input type="datetime-local" class="form-control" id="recipient-name">
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="recipient-name" class="col-form-label">Rules & Details:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="mb-6">
                        <label for="recipient-name" class="col-form-label">Location:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="d-flex flex-row justify-content-between dates-inputs">
                        <div>
                            <label for="ticket_price" class="col-form-label">Ticket Price:</label>
                            <input type="number" class="form-control" id="ticket_price">
                        </div>
                        <div>
                            <label for="tickets_n" class="col-form-label">Number of Tickets :</label>
                            <input type="number" class="form-control" id="tickets_n">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
