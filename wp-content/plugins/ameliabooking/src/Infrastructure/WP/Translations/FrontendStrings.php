<?php

namespace AmeliaBooking\Infrastructure\WP\Translations;

use AmeliaBooking\Domain\Services\Settings\SettingsService;
use AmeliaBooking\Infrastructure\WP\SettingsService\SettingsStorage;

/**
 * Class FrontendStrings
 *
 * @package AmeliaBooking\Infrastructure\WP\Translations
 */
class FrontendStrings
{
    /** @var array */
    private static $settings;

    /**
     * Set Settings
     *
     * @return array|mixed
     */
    public static function getLabelsFromSettings()
    {
        if (!self::$settings) {
            self::$settings = (new SettingsService(new SettingsStorage()))->getCategorySettings('labels');
        }

        return self::$settings;
    }

    /**
     * Return all strings for frontend
     *
     * @return array
     */
    public static function getAllStrings()
    {
        return array_merge(
            self::getCommonStrings(),
            self::getBookingStrings(),
            self::getCatalogStrings(),
            self::getSearchStrings(),
            self::getLabelsFromSettings()
        );
    }

    /**
     * Returns the array of the common frontend strings
     *
     * @return array
     */
    public static function getCommonStrings()
    {
        return [
            'add_coupon'                 => __('Add Coupon', 'wpamelia'),
            'add_to_calendar'            => __('Add to Calendar', 'wpamelia'),
            'back'                       => __('Back', 'wpamelia'),
            'base_price_colon'           => __('Base Price:', 'wpamelia'),
            'booking_already_in_wc_cart' => __('Booking is already in WooCommerce cart', 'wpamelia'),
            'booking_completed_approved' => __('Thank you! Your booking is completed.', 'wpamelia'),
            'booking_completed_pending'  => __(
                'Thank you! Your booking is completed and now is pending confirmation.',
                'wpamelia'
            ),
            'booking_completed_email'    => __(
                'An email with details of your booking has been sent to you.',
                'wpamelia'
            ),
            'cancel'                     => __('Cancel', 'wpamelia'),
            'capacity_colon'             => __('Capacity:', 'wpamelia'),
            'confirm'                    => __('Confirm', 'wpamelia'),
            'congratulations'            => __('Congratulations', 'wpamelia'),
            'coupon_used'                => __('Used coupon', 'wpamelia'),
            'coupon_invalid'             => __('This coupon is not valid anymore', 'wpamelia'),
            'coupon_unknown'             => __('The coupon you entered is not valid', 'wpamelia'),
            'coupon_missing'             => __('Please enter coupon', 'wpamelia'),
            'credit_or_debit_card_colon' => __('Credit or debit card:', 'wpamelia'),
            'credit_card'                => __('Credit Card', 'wpamelia'),
            'customer_already_booked'    => __('You have already booked this appointment', 'wpamelia'),
            'date_colon'                 => __('Date:', 'wpamelia'),
            'discount_amount_colon'      => __('Discount:', 'wpamelia'),
            'duration_colon'             => __('Duration:', 'wpamelia'),
            'email_colon'                => __('Email:', 'wpamelia'),
            'email_exist_error'          => __(
                'Email already exists with different name. Please check your name.',
                'wpamelia'
            ),
            'email_not_sent_error'       => __(
                'Unfortunately a server error occurred and your email was not sent.',
                'wpamelia'
            ),
            'email_placeholder'          => __('example@mail.com', 'wpamelia'),
            'enter_email_warning'        => __('Please enter email', 'wpamelia'),
            'enter_first_name_warning'   => __('Please enter first name', 'wpamelia'),
            'enter_last_name_warning'    => __('Please enter last name', 'wpamelia'),
            'enter_phone_warning'        => __('Please enter phone number', 'wpamelia'),
            'enter_valid_email_warning'  => __('Please enter a valid email address', 'wpamelia'),
            'enter_valid_phone_warning'  => __('Please enter a valid phone number', 'wpamelia'),
            'extras_costs_colon'         => __('Extras Cost:', 'wpamelia'),
            'first_name_colon'           => __('First Name:', 'wpamelia'),
            'h'                          => __('h', 'wpamelia'),
            'incomplete_cvc'             => __('Your card\'s security code is incomplete', 'wpamelia'),
            'incomplete_expiry'          => __('Your card\'s expiration date is incomplete', 'wpamelia'),
            'incomplete_number'          => __('Your card number is incomplete', 'wpamelia'),
            'incomplete_zip'             => __('Your postal code is incomplete', 'wpamelia'),
            'invalid_expiry_year_past'   => __('Your card\'s expiration year is in the past', 'wpamelia'),
            'invalid_number'             => __('Your card number is invalid', 'wpamelia'),
            'last_name_colon'            => __('Last Name:', 'wpamelia'),
            'location_colon'             => __('Location:', 'wpamelia'),
            'min'                        => __('min', 'wpamelia'),
            'number_of_persons_colon'    => __('Number of Persons:', 'wpamelia'),
            'on_site'                    => __('On-site', 'wpamelia'),
            'pay_pal'                    => __('PayPal', 'wpamelia'),
            'payment_error'              => __(
                'Sorry, there was an error processing your payment. Please try again later.',
                'wpamelia'
            ),
            'payment_method_colon'       => __('Payment Method:', 'wpamelia'),
            'persons'                    => __('persons', 'wpamelia'),
            'phone_colon'                => __('Phone:', 'wpamelia'),
            'please_wait'                => __('Please Wait', 'wpamelia'),
            'price_colon'                => __('Price:', 'wpamelia'),
            'required_field'             => __('This field is required', 'wpamelia'),
            'select_calendar'            => __('Select Calendar', 'wpamelia'),
            'stripe'                     => __('Stripe', 'wpamelia'),
            'subtotal_colon'             => __('Subtotal:', 'wpamelia'),
            'time_colon'                 => __('Time:', 'wpamelia'),
            'time_slot_unavailable'      => __('Time slot is unavailable', 'wpamelia'),
            'total_cost_colon'           => __('Total Cost:', 'wpamelia'),
            'waiting_for_payment'        => __('Waiting for payment', 'wpamelia'),
            'wc'                         => __('On-line', 'wpamelia'),
            'wc_error'                   => __(
                'Sorry, there was an error while adding booking to WooCommerce cart.',
                'wpamelia'
            ),
            'wc_appointment_is_removed'  => __('Appointment is removed from the cart.', 'wpamelia'),
            'wc_appointment_remove'      => __('On-line', 'wpamelia'),
            'wc_product_name'            => __('Appointment', 'wpamelia'),
        ];
    }

    /**
     * Returns the array of the frontend strings for the search shortcode
     *
     * @return array
     */
    public static function getSearchStrings()
    {
        return [
            'appointment_date_colon'  => __('Appointment Date:', 'wpamelia'),
            'book'                    => __('Book', 'wpamelia'),
            'bringing_anyone'         => __('Bringing anyone with you?', 'wpamelia'),
            'enter_appointment_date'  => __('Please enter appointment date...', 'wpamelia'),
            'from'                    => __('From', 'wpamelia'),
            'name_asc'                => __('Name Ascending', 'wpamelia'),
            'name_desc'               => __('Name Descending', 'wpamelia'),
            'next'                    => __('Next', 'wpamelia'),
            'no_results_found'        => __('No results found...', 'wpamelia'),
            'of'                      => __('of', 'wpamelia'),
            'price_asc'               => __('Price Ascending', 'wpamelia'),
            'price_desc'              => __('Price Descending', 'wpamelia'),
            'refine_search'           => __('Please refine your search criteria', 'wpamelia'),
            'results'                 => __('results', 'wpamelia'),
            'search'                  => __('Search...', 'wpamelia'),
            'search_filters'          => __('Search Filters', 'wpamelia'),
            'search_results'          => __('Search Results', 'wpamelia'),
            'select'                  => __('Select', 'wpamelia'),
            'select_appointment_time' => __('Select the Appointment Time', 'wpamelia'),
            'select_extras'           => __('Select the Extras you\'d like', 'wpamelia'),
            'select_location'         => __('Select Location', 'wpamelia'),
            'showing'                 => __('Showing', 'wpamelia'),
            'time_range_colon'        => __('Time Range:', 'wpamelia'),
            'to_lower'                => __('to', 'wpamelia'),
            'to_upper'                => __('To', 'wpamelia'),
        ];
    }

    /**
     * Returns the array of the frontend strings for the booking shortcode
     *
     * @return array
     */
    public static function getBookingStrings()
    {
        return [
            'add_extra'                => __('Add extra', 'wpamelia'),
            'any'                      => __('Any', 'wpamelia'),
            'book_appointment'         => __('Book Appointment', 'wpamelia'),
            'bringing_anyone_with_you' => __('Bringing anyone with you?', 'wpamelia'),
            'continue'                 => __('Continue', 'wpamelia'),
            'extra_colon'              => __('Extra:', 'wpamelia'),
            'person_upper'             => __('Person', 'wpamelia'),
            'persons_upper'            => __('Persons', 'wpamelia'),
            'pick_date_and_time_colon' => __('Pick date & time:', 'wpamelia'),
            'please_select'            => __('Please select', 'wpamelia'),
            'qty_colon'                => __('Qty:', 'wpamelia'),
        ];
    }

    /**
     * Returns the array of the frontend strings for the catalog shortcode
     *
     * @return array
     */
    public static function getCatalogStrings()
    {
        return [
            'booking_appointment'    => __('Booking Appointment', 'wpamelia'),
            'buffer_time'            => __('Buffer Time', 'wpamelia'),
            'categories'             => __('Categories', 'wpamelia'),
            'category_colon'         => __('Category:', 'wpamelia'),
            'description'            => __('Description', 'wpamelia'),
            'description_colon'      => __('Description:', 'wpamelia'),
            'extras'                 => __('Extras', 'wpamelia'),
            'info'                   => __('Info', 'wpamelia'),
            'maximum_quantity_colon' => __('Maximum Quantity:', 'wpamelia'),
            'view_more'              => __('View More', 'wpamelia'),
        ];
    }
}
