@extends('layouts.owner')

@section('title', 'Reservations')

@section('content')
<div class="mx-5 my-3">
    <div class="row mt-5">
        @include('restaurant-owners.sidebar')

        <div class="col-12 col-lg-9">

            <div class="row g-3 my-3">
                <div class="col-12 col-lg-6 mb-3">
                    <div class="input-group search-group">
                        <span class="input-group-text bg-white">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" id="nameSearch" class="form-control" placeholder="Search customer name">
                    </div>
                </div>
                <div class="col-12 col-lg-3 mb-3">
                     <input type="date" id="dateFilter" class="form-control date-input">
                </div>
                <div class="col-12 col-lg-3 mb-3">
                    <select id="statusFilter" class="form-select filter-select" style="border: none;">
                        <option value="">All Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Confirmed">Confirmed</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="No-show">No-show</option>
                    </select>
                </div>
            </div>

            {{-- calendar / table area --}}
            <div class="row g-4 mb-5">
                <div class="col-12 col-xl-5">
                    <div class="card p-4 calendar-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <button type="button" id="prevMonth" class="btn btn-sm btn-light calendar-nav-btn">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>

                            <h4 id="calendarTitle" class="mb-0 text-center flex-grow-1">February 2026</h4>

                            <button type="button" id="nextMonth" class="btn btn-sm btn-light calendar-nav-btn">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>

                        <table class="table table-borderless text-center calendar-table mb-0">
                            <thead>
                                <tr>
                                    <th>Sun</th>
                                    <th>Mon</th>
                                    <th>Tue</th>
                                    <th>Wed</th>
                                    <th>Thu</th>
                                    <th>Fri</th>
                                    <th>Sat</th>
                                </tr>
                            </thead>
                            <tbody id="calendarBody">
                                {{-- JS --}}
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-12 col-xl-7">
                    <button class="btn btn-orange mb-3" data-bs-toggle="modal" data-bs-target="#addReservationModal">+ Add Reservation</button>
                    <div class="card p-4 reservation-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="mb-0 text-underline-accent">Reservations</h3>
                            <small id="selectedDateLabel" class="text-muted"></small>
                        </div>

                        <div class="table-responsive" style="font-family: 'Sen','sane-serif';">
                            <table class="table table-sm align-middle reservation-table table-hover">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Name</th>
                                        <th>Guests</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservations as $reservation)
                                      <tr>
                                        <td>{{ $reservation->reservation_time }}</td>
                                        <td>{{ $reservation->full_name }}</td>
                                        <td class="ps-4">{{ $reservation->number_of_people }}</td>
                                        <td>{{ $reservation->phone }}</td>
                                        <td>
                                            @php
                                                $statusClass = match($reservation->status) {
                                                    'pending' => 'bg-warning text-dark',
                                                    'confirmed' => 'bg-success',
                                                    'cancelled' => 'bg-danger',
                                                    'no-show' => 'bg-secondary',
                                                    default => 'bg-light text-dark',
                                                };
                                            @endphp
                                            <span class="p-2 badge rounded-pill {{ $statusClass }}">{{ $reservation->status}}</span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editReservationModal" data-id="${item.id}">Edit</button>
                                        </td>
                                      </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $reservations->links('layouts.pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
 @include('restaurant-owners.reservations.modals.add')
 @include('restaurant-owners.reservations.modals.edit')
@endsection

    @push('scripts')
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarTitle = document.getElementById('calendarTitle');
            const calendarBody = document.getElementById('calendarBody');
            const reservationTableBody = document.getElementById('reservationTableBody');
            const selectedDateLabel = document.getElementById('selectedDateLabel');

            const prevMonthBtn = document.getElementById('prevMonth');
            const nextMonthBtn = document.getElementById('nextMonth');

            const statusFilter = document.getElementById('statusFilter');
            const dateFilter = document.getElementById('dateFilter');
            const nameSearch = document.getElementById('nameSearch');
           
            // dummy reservation data for demonstration
            const reservationData = {
                '2026-02-10': [
                    { time: '18:30', name: 'John Smith', guests: 2, phone: '0912345678', status: 'Pending' },
                    { time: '19:00', name: 'Emily Brown', guests: 4, phone: '0809876543', status: 'Confirmed' },
                    { time: '20:00', name: 'Ken Tanaka', guests: 3, phone: '0701234567', status: 'Completed' }
                ],
                '2026-02-11': [
                    { time: '17:30', name: 'Sarah Lee', guests: 2, phone: '09011112222', status: 'Pending' }
                ],
                '2026-02-15': [
                    { time: '19:30', name: 'Michael Chen', guests: 5, phone: '09033334444', status: 'Cancelled' }
                ],
                '2026-02-20': [
                    { time: '18:00', name: 'Alice Johnson', guests: 2, phone: '08022223333', status: 'Confirmed' },
                    { time: '19:30', name: 'David Lee', guests: 6, phone: '08099998888', status: 'No-show' }
                ],
                '2026-03-03': [
                    { time: '18:00', name: 'Emma Wilson', guests: 2, phone: '09012344321', status: 'Confirmed' }
                ]
            };

            let currentDate = new Date(2026, 1, 10); // Feb 10, 2026
            let selectedDate = formatDate(currentDate);

            dateFilter.value = selectedDate;

            function formatDate(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            function formatMonthTitle(date) {
                return date.toLocaleDateString('en-US', {
                    month: 'long',
                    year: 'numeric'
                });
            }

            function formatSelectedDateLabel(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric'
                });
            }

            function escapeHtml(str) {
                return String(str)
                    .replaceAll('&', '&amp;')
                    .replaceAll('<', '&lt;')
                    .replaceAll('>', '&gt;')
                    .replaceAll('"', '&quot;')
                    .replaceAll("'", '&#039;');
            }

            function getStatusBadge(status) {
                switch (status) {
                    case 'Pending':
                        return '<span class="badge bg-warning text-dark">Pending</span>';
                    case 'Confirmed':
                        return '<span class="badge bg-success">Confirmed</span>';
                    case 'Completed':
                        return '<span class="badge bg-primary">Completed</span>';
                    case 'Cancelled':
                        return '<span class="badge bg-danger">Cancelled</span>';
                    case 'No-show':
                        return '<span class="badge bg-secondary">No-show</span>';
                    default:
                        return `<span class="badge bg-light text-dark">${escapeHtml(status)}</span>`;
                }
            }

            function renderCalendar(date) {
                const year = date.getFullYear();
                const month = date.getMonth();

                calendarTitle.textContent = formatMonthTitle(date);

                const firstDayOfMonth = new Date(year, month, 1);
                const lastDayOfMonth = new Date(year, month + 1, 0);
                const startDayIndex = firstDayOfMonth.getDay();
                const daysInMonth = lastDayOfMonth.getDate();

                const prevMonthLastDate = new Date(year, month, 0).getDate();

                let html = '';
                let day = 1;
                let nextMonthDay = 1;

                for (let row = 0; row < 6; row++) {
                    html += '<tr>';

                    for (let col = 0; col < 7; col++) {
                        if (row === 0 && col < startDayIndex) {
                            const prevDay = prevMonthLastDate - startDayIndex + col + 1;
                            html += `<td class="is-other-month">${prevDay}</td>`;
                        } else if (day > daysInMonth) {
                            html += `<td class="is-other-month">${nextMonthDay}</td>`;
                            nextMonthDay++;
                        } else {
                            const cellDate = new Date(year, month, day);
                            const cellDateStr = formatDate(cellDate);

                            const hasDataClass = reservationData[cellDateStr] ? 'has-data' : '';
                            const selectedClass = cellDateStr === selectedDate ? 'is-selected' : '';

                            html += `
                                <td
                                    class="calendar-date ${hasDataClass} ${selectedClass}"
                                    data-date="${cellDateStr}"
                                >
                                    ${day}
                                </td>
                            `;
                            day++;
                        }
                    }

                    html += '</tr>';

                    if (day > daysInMonth) {
                        break;
                    }
                }

                calendarBody.innerHTML = html;

                document.querySelectorAll('.calendar-date').forEach(cell => {
                    cell.addEventListener('click', function () {
                        selectedDate = this.dataset.date;
                        currentDate = new Date(selectedDate);
                        dateFilter.value = selectedDate;

                        renderCalendar(currentDate);
                        renderReservations();
                    });
                });
            }

            function renderReservations() {
                const allRowsForSelectedDate = reservationData[selectedDate] || [];
                const selectedStatus = statusFilter.value;
                const searchText = nameSearch.value.trim().toLowerCase();

                console.log('selectedDate:', selectedDate);
                console.log('selectedStatus:', selectedStatus);
                console.log('rows:', allRowsForSelectedDate);

                const filteredRows = allRowsForSelectedDate.filter(item => {
                    const matchStatus = selectedStatus ? item.status === selectedStatus : true;
                    const matchName = searchText ? item.name.toLowerCase().includes(searchText) : true;
                    return matchStatus && matchName;
                });

                 console.log('filteredRows:', filteredRows);

                selectedDateLabel.textContent = formatSelectedDateLabel(selectedDate);

                if (filteredRows.length === 0) {
                    reservationTableBody.innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No reservations found.
                            </td>
                        </tr>
                    `;
                    return;
                }

                reservationTableBody.innerHTML = filteredRows.map(item => `
                    <tr onclick="window.location='/reservations/${item.id}'" style="cursor:pointer;">
                        <td>${escapeHtml(item.time)}</td>
                        <td>${escapeHtml(item.name)}</td>
                        <td class="ps-4">${escapeHtml(item.guests)}</td>
                        <td>${escapeHtml(item.phone)}</td>
                        <td>${getStatusBadge(item.status)}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editReservationModal" data-id="${item.id}">Edit</button>
                        </td>
                    </tr>
                `).join('');
            }

            prevMonthBtn.addEventListener('click', function () {
                currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1, 1);

                const firstDayOfNewMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
                selectedDate = formatDate(firstDayOfNewMonth);
                dateFilter.value = selectedDate;

                renderCalendar(currentDate);
                renderReservations();
            });

            nextMonthBtn.addEventListener('click', function () {
                currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 1);

                const firstDayOfNewMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
                selectedDate = formatDate(firstDayOfNewMonth);
                dateFilter.value = selectedDate;

                renderCalendar(currentDate);
                renderReservations();
            });

            dateFilter.addEventListener('change', function () {
                if (!this.value) return;

                selectedDate = this.value;
                currentDate = new Date(this.value);

                renderCalendar(currentDate);
                renderReservations();
            });

            statusFilter.addEventListener('change', function () {
                renderReservations();
            });

            nameSearch.addEventListener('input', function () {
                renderReservations();
            });

            renderCalendar(currentDate);
            renderReservations();
        });
        </script>
    @endpush
