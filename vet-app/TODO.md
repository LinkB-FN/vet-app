# Fortnite Coaching Dashboard Transformation - TODO

## Phase 1: Database Layer (Migrations & Models) ✅
- [x] Create migration to rename owners table to account_owners and update fields
- [x] Create migration to rename pets table to fortnite_accounts and update fields
- [x] Create migration to rename appointments table to coaching_sessions and update fields
- [x] Rename Owner.php to AccountOwner.php and update content
- [x] Rename Pet.php to FortniteAccount.php and update content
- [x] Rename Appointment.php to CoachingSession.php and update content
- [x] Update AccountOwnerFactory.php with Fortnite data
- [x] Update FortniteAccountFactory.php with Fortnite data
- [x] Update CoachingSessionFactory.php with Fortnite data

## Phase 2: Application Layer (Controllers) ✅
- [x] Rename OwnerController.php to AccountOwnerController.php and update content
- [x] Rename PetController.php to FortniteAccountController.php and update content
- [x] Rename AppointmentController.php to CoachingSessionController.php and update content

## Phase 3: Routes ✅
- [x] Update routes/web.php with new controller and route names

## Phase 4: Views Layer ✅
- [x] Update dashboard.blade.php with Fortnite terminology
- [x] Update sidebar.blade.php with new navigation and icons
- [x] Rename and update owners views to account-owners (4 files)
- [x] Rename and update pets views to fortnite-accounts (4 files)
- [x] Rename and update appointments views to coaching-sessions (4 files)

## Phase 5: Seeder & Final Steps ✅
- [x] Update DatabaseSeeder.php with Fortnite sample data

## Phase 6: Testing & Deployment 🚀
- [ ] Run migrations: `php artisan migrate:fresh`
- [ ] Run seeders: `php artisan db:seed`
- [ ] Test all CRUD operations
- [ ] Verify navigation and UI
- [ ] Test role-based access

---
**Status:** 🎉 ALL CODE FILES COMPLETED! Ready for testing and deployment.

## Summary of Changes:
- ✅ 3 new migrations created
- ✅ 3 new models created (AccountOwner, FortniteAccount, CoachingSession)
- ✅ 3 new factories with Fortnite data
- ✅ 3 new controllers created
- ✅ Routes updated
- ✅ Dashboard and sidebar updated
- ✅ 12 new view files created (4 for each entity)
- ✅ DatabaseSeeder updated with Fortnite theme

## Next Steps:
1. Run `php artisan migrate:fresh` to apply all migrations
2. Run `php artisan db:seed` to populate with sample data
3. Login with: admin@fortnitecoaching.com / password
4. Test all functionality
