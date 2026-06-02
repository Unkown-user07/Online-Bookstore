-- Run this in Supabase Studio SQL Editor (http://127.0.0.1:54323)
-- after running: supabase start

-- The tasks table is created by Laravel migration (php artisan migrate).
-- This file is for reference / manual setup only.

-- Disable RLS for testing
alter table tasks disable row level security;

-- Optional: verify
select * from tasks;
